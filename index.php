<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table Columns</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .custom-column {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 8px;
        }

        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>User Data Table</h2>
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Toggle Columns
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropdownMenuButton1">
                    <label class="dropdown-item toggle-column" data-column="name"><input type="checkbox" class="mr-2" checked>Name</label>
                    <label class="dropdown-item toggle-column" data-column="nickname"><input type="checkbox" class="mr-2" checked>Nickname</label>
                    <label class="dropdown-item toggle-column" data-column="mobile"><input type="checkbox" class="mr-2" checked>Mobile</label>
                    <label class="dropdown-item toggle-column" data-column="email"><input type="checkbox" class="mr-2" checked>Email</label>
                    <label class="dropdown-item toggle-column" data-column="role"><input type="checkbox" class="mr-2" checked>Role</label>
                    <label class="dropdown-item toggle-column" data-column="address"><input type="checkbox" class="mr-2" checked>Address</label>
                    <label class="dropdown-item toggle-column" data-column="gender"><input type="checkbox" class="mr-2" checked>Gender</label>
                    <label class="dropdown-item toggle-column" data-column="profile_image"><input type="checkbox" class="mr-2" checked>Profile Image</label>
                </div>
            </div>
            <button id="add-column-btn" class="btn btn-primary">Add Custom Column</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th class="column-name">Name</th>
                        <th class="column-nickname">Nickname</th>
                        <th class="column-mobile">Mobile</th>
                        <th class="column-email">Email</th>
                        <th class="column-role">Role</th>
                        <th class="column-address">Address</th>
                        <th class="column-gender">Gender</th>
                        <th class="column-profile_image">Profile Image</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <!-- User data will be appended here -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            const userId = new URLSearchParams(window.location.search).get('user_id');

            // Fetch and display custom columns
            $.getJSON(`customColumnsList.php?user_id=${userId}`, function(customColumns) {
                customColumns.forEach(col => {
                    const isVisible = col.is_visible == 1;
                    const columnClass = col.column_class.replace(/\s+/g, '-').toLowerCase(); // Replace spaces with hyphens for class names
                    if ($(`.column-${columnClass}`).length === 0) {
                        $('thead tr').append(`<th class="column-${columnClass}" style="display: ${isVisible ? 'table-cell' : 'none'};">${col.column_name}</th>`);
                        $('#user-table-body tr').each(function() {
                            $(this).append(`<td class="column-${columnClass}" style="display: ${isVisible ? 'table-cell' : 'none'};"></td>`);
                        });
                    }
                    $('#dropdownMenuButton1').append(`
                        <label class="dropdown-item toggle-column" data-column="${columnClass}">
                            <input type="checkbox" class="mr-2" ${isVisible ? 'checked' : ''}>${col.column_name}
                        </label>
                    `);
                });

                // Ensure initial state matches stored preferences
                loadColumnState();

                // Hide columns that are marked as invisible on initial load
                $('.dropdown-item.toggle-column').each(function() {
                    const column = $(this).data('column');
                    const isChecked = $(this).find('input[type="checkbox"]').is(':checked');
                    $(`.column-${column}`).toggle(isChecked);
                });

                // Make custom columns editable after loading data
                makeColumnsEditable();
            });

            // Toggle columns
            $(document).on('change', '.dropdown-item.toggle-column input[type="checkbox"]', function(e) {
                const column = $(this).parent().data('column');
                const isChecked = $(this).is(':checked');
                $(`.column-${column}`).toggle(isChecked);
                saveColumnState();
                updateColumnVisibility(column, isChecked);
            });

            // Fetch user data and populate table
            $.getJSON('fetch_user_data.php', function(data) {
                let rows = '';
                let headers = [];
                $('#table thead th').each(function() {
                    const columnName = $(this).attr('class').replace('column-', ''); // Extract class name without 'column-' prefix
                    headers.push(columnName);
                });

                data.forEach(user => {
                    rows += '<tr>';
                    headers.forEach(columnName => {
                        if (user[columnName] !== undefined) {
                            if (columnName === 'profile_image') {
                                rows += `<td class="column-${columnName}"><img src="${user[columnName]}" alt="Profile Image" width="50"></td>`;
                            } else {
                                if ($(`.column-${columnName}`).hasClass('custom-column')) {
                                    rows += `<td class="column-${columnName} custom-column" contenteditable="true">${user[columnName]}</td>`;
                                } else {
                                    rows += `<td class="column-${columnName}">${user[columnName]}</td>`;
                                }
                            }
                        } else {
                            rows += `<td class="column-${columnName}">-</td>`;
                        }
                    });
                    rows += '</tr>';
                });

                $('#user-table-body').html(rows);
                loadColumnState();
            });

            // Add custom column
            $('#add-column-btn').click(function() {
                const columnName = prompt("Enter custom column name:");
                if (columnName) {
                    const columnClass = columnName.replace(/\s+/g, '-').toLowerCase();
                    if ($(`.column-${columnClass}`).length === 0) {
                        $('thead tr').append(`<th class="column-${columnClass}">${columnName}</th>`);
                        $('#user-table-body tr').append(`<td class="column-${columnClass} custom-column" style="display: table-cell;" contenteditable="true"></td>`);
                        $('#dropdownMenuButton1').append(`
                            <label class="dropdown-item toggle-column" data-column="${columnClass}">
                                <input type="checkbox" class="mr-2" checked>${columnName}
                            </label>
                        `);
                        saveCustomColumns(columnClass, columnName);
                    } else {
                        alert('A column with this name already exists.');
                    }
                }
            });

            // Save custom columns to the server
            function saveCustomColumns(columnClass, columnName) {
                const userId = new URLSearchParams(window.location.search).get('user_id');
                $.post('save_custom_column.php', {
                    user_id: userId,
                    column_name: columnName,
                    column_class: columnClass
                }).done(function(response) {
                    console.log(response);
                }).fail(function(error) {
                    console.error("Error saving custom column:", error);
                });
            }

            // Save column state to local storage
            function saveColumnState() {
                const columnState = {};
                $('.dropdown-item.toggle-column').each(function() {
                    const column = $(this).data('column');
                    columnState[column] = $(`.column-${column}`).is(':visible');
                });
                const userId = new URLSearchParams(window.location.search).get('user_id');
                localStorage.setItem(`columnState_${userId}`, JSON.stringify(columnState));
            }

            // Load column state from local storage
            function loadColumnState() {
                const userId = new URLSearchParams(window.location.search).get('user_id');
                const columnState = JSON.parse(localStorage.getItem(`columnState_${userId}`));
                if (columnState) {
                    $('.dropdown-item.toggle-column').each(function() {
                        const column = $(this).data('column');
                        const isVisible = columnState[column];
                        $(`.column-${column}`).toggle(isVisible);
                        $(this).find('input').prop('checked', isVisible);
                    });
                }
            }

            // Make custom columns editable
            function makeColumnsEditable() {
                $('#user-table-body').on('blur', 'td.custom-column[contenteditable="true"]', function() {
                    const columnClass = $(this).attr('class').replace('column-', ''); // Extract class name without 'column-' prefix
                    const newValue = $(this).text().trim();
                    updateColumnValue(columnClass, newValue);
                });
            }

            // Update column value in the database
            function updateColumnValue(columnClass, newValue) {
                const userId = new URLSearchParams(window.location.search).get('user_id');
                $.post('update_custom_column_value.php', {
                    user_id: userId,
                    column_class: columnClass,
                    new_value: newValue
                }).done(function(response) {
                    console.log(response);
                }).fail(function(error) {
                    console.error("Error updating column value:", error);
                });
            }

            // Update column visibility on the server
            function updateColumnVisibility(columnClass, isVisible) {
                const userId = new URLSearchParams(window.location.search).get('user_id');
                $.post('customColumnsToggle.php', {
                    user_id: userId,
                    column_class: columnClass,
                    is_visible: isVisible ? 1 : 0
                }).done(function(response) {
                    console.log(response);
                }).fail(function(error) {
                    console.error("Error updating column visibility:", error);
                });
            }
        });
    </script>
</body>

</html>
