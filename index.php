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
    <div class="container-xl mt-5">
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
            <div>
                <button id="add-column-btn" class="btn btn-primary">Add Custom Column</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add User
                </button>
            </div>

            <!-- user add modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <form class="modal-content" id="add-user-form" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-3">
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="nickname">Nickname</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="role">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="profile_image">Profile Image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image" required>
                                </div>
                                <!-- Add custom column fields dynamically here -->
                                <div class="col-12">
                                    <div id="custom-column-fields" class="row"></div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- user edit modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <form class="modal-content" id="edit-user-form" enctype="multipart/form-data">
                        <input type="hidden" id="edit-user-id" name="edit-user-id" />
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-3">
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-name">Name</label>
                                    <input type="text" class="form-control" id="edit-name" name="name" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-nickname">Nickname</label>
                                    <input type="text" class="form-control" id="edit-nickname" name="nickname" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-mobile">Mobile</label>
                                    <input type="text" class="form-control" id="edit-mobile" name="mobile" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-email">Email</label>
                                    <input type="email" class="form-control" id="edit-email" name="email" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-role">Role</label>
                                    <input type="text" class="form-control" id="edit-role" name="role" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-address">Address</label>
                                    <input type="text" class="form-control" id="edit-address" name="address" required>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-gender">Gender</label>
                                    <select class="form-control" id="edit-gender" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="edit-profile_image">Profile Image</label>
                                    <input type="file" class="form-control" id="edit-profile_image" name="profile_image">
                                </div>
                                <!-- Add custom column fields dynamically here -->
                                <div class="col-12">
                                    <div id="edit-custom-column-fields" class="row"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

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
                        <th class="column-action">Action</th>
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
                    const columnClass = col.column_class.replace(/\s+/g, '-').toLowerCase();
                    if ($(`.column-${columnClass}`).length === 0) {
                        $('thead tr').append(`<th class="column-${columnClass}" style="display: ${isVisible ? 'table-cell' : 'none'};">${col.column_name}</th>`);
                        $('#user-table-body tr').each(function() {
                            $(this).append(`<td class="column-${columnClass}" style="display: ${isVisible ? 'table-cell' : 'none'};"></td>`);
                        });
                    }
                    $('#dropdownMenuButton1').append(
                        `<label class="dropdown-item toggle-column" data-column="${columnClass}">
                        <input type="checkbox" class="mr-2" ${isVisible ? 'checked' : ''}>${col.column_name}
                    </label>`
                    );

                    // Add custom column fields to the form
                    $('#custom-column-fields').append(
                        `<div class="form-group col-12 col-sm-6">
                        <label for="${columnClass}">${col.column_name}</label>
                        <input type="text" class="form-control" id="${columnClass}" name="${columnClass}">
                    </div>`
                    );
                });

                // Ensure initial state matches stored preferences
                loadColumnState();

                // Hide columns that are marked as invisible on initial load
                $('.dropdown-item.toggle-column').each(function() {
                    const column = $(this).data('column');
                    const isChecked = $(this).find('input[type="checkbox"]').is(':checked');
                    $(`.column-${column}`).toggle(isChecked);
                });

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
            function fetchUserData() {
                $.getJSON('fetch_user_data.php', function(data) {
                    let rows = '';
                    let headers = [];
                    $('#table thead th').each(function() {
                        const columnName = $(this).attr('class').replace('column-', '');
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
                        rows += `<td class="column-action"><button class="btn btn-primary btn-edit" data-id="${user.id}">Edit</button></td>`; // Ensure this line is present and correctly placed
                        rows += '</tr>';
                    });

                    $('#user-table-body').html(rows);
                    loadColumnState();
                });
            }

            fetchUserData();

            // Handle edit button click
            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                console.log('id', id)
                $.getJSON(`fetchUserData.php?id=${id}`, function(user) {
                    $('#edit-user-id').val(id);
                    $('#edit-name').val(user.name);
                    $('#edit-nickname').val(user.nickname);
                    $('#edit-mobile').val(user.mobile);
                    $('#edit-email').val(user.email);
                    $('#edit-role').val(user.role);
                    $('#edit-address').val(user.address);
                    $('#edit-gender').val(user.gender);
                    // Populate custom fields if any
                    // Open the modal
                    $('#editModal').modal('show');
                });
            });

            // Add custom column
            $('#add-column-btn').click(function() {
                const columnName = prompt("Enter custom column name:");
                if (columnName) {
                    const columnClass = columnName.replace(/\s+/g, '-').toLowerCase();
                    if ($(`.column-${columnClass}`).length === 0) {
                        $('thead tr').append(`<th class="column-${columnClass}">${columnName}</th>`);
                        $('#user-table-body tr').append(`<td class="column-${columnClass} custom-column" style="display: table-cell;" contenteditable="true"></td>`);
                        $('#dropdownMenuButton1').append(
                            `<label class="dropdown-item toggle-column" data-column="${columnClass}">
                            <input type="checkbox" class="mr-2" checked>${columnName}
                        </label>`
                        );
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
                $.post('customColumnEdit.php', {
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

            // Handle form submission for adding a new user
            $('#add-user-form').submit(function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const userId = new URLSearchParams(window.location.search).get('user_id');

                $.ajax({
                    url: 'add_user.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        // Display success message
                        alert('User added successfully!');
                        fetchUserData();
                        // Close the modal
                        $('#exampleModal').modal('toggle');

                        // Clear the form
                        $('#add-user-form')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding user:", xhr.responseText);
                    }
                });
            });


            // Handle form submission for editing a user
            $('#edit-user-form').submit(function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const id = $('#edit-user-id').val();
                formData.append('user_id', userId);
                formData.append('id', id);
                $.ajax({
                    url: 'editUserData.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        // Display success message
                        alert('User updated successfully!');
                        fetchUserData();
                        // Close the modal
                        $('#editModal').modal('toggle');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating user:", xhr.responseText);
                    }
                });
            });


        });
    </script>

</body>

</html>