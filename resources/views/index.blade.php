<!doctype html>
<html lang="en">

<head>
    <title>Contacts-Book</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            min-height: 100vh;
            background-color: rgb(57, 73, 94);
        }

        .ellipsis {
            color: white;
        }

        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');

        * {
            font-family: 'Ubuntu', sans-serif;
        }

        #myTable_previous {
            background-color: #2c3034;
            color: #97A1A9 !important;
        }

        #myTable_next {
            background-color: #2c3034;
            color: #97A1A9 !important;
        }

        #myTable_info {
            color: #97A1A9 !important;
        }

        #myTable_filter {
            color: #97A1A9 !important;
        }

        #myTable_filter label input {
            color: white;
        }

        #myTable_length {
            color: #97A1A9 !important;

        }

        #myTable_length label select {
            color: white;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #97A1A9 !important;
            background-color: gray;
        }

        input[type=checkbox] {
            background-color: transparent;

        }

        #myTable_length select {
            background-color: #2c3034;
            color: white;
        }

        /* .btn-outline-secondary:hover{
            border-color: yellow;
        } */
        .modal_btn {
            border-color: #14AFF1 !important;
            color: #14AFF1 !important;
        }

        .label_name {
            color: #97A1A9 !important;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }

        .modal_input {
            padding: 1px !important;
            border-color: #356680 !important;
            color: white !important;
        }

        #titleCss {
            cursor: pointer;
            text-decoration: underline;
        }
    </style>

    <!-- data table.net cdn  -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- data table.net cdn end -->

    <!-- year picker script -->
    <link rel="stylesheet" href="../Year-Picker-Text-Input/dist/yearpicker.css">

    <!-- sweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body class="mb-5">
    @if (session('status'))
    <div class="alert alert-success alert-dismissible">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible">
        {{$error}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach
    @endif
    <div class="container ">
        <h1 class="text-white text-center mt-4">
            Contacts Book
        </h1>
        <div class="text-end">
            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#contactModal">Add Contact</button>
        </div>
        <div class="card bg-dark rounded mt-3"
            style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;position: relative; z-index: 1;">
            <div class="card-body">
                <table class="table table-dark table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{$contact->id}}</td>
                            <td>{{$contact->first_name}}</td>
                            <td>{{$contact->last_name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->phone}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" href="#" data-action="edit" onclick="editContact(<?php echo htmlspecialchars(json_encode($contact)); ?>)">Edit</button>
                                <form class="d-inline-block" action="{{ route('destroy',$contact->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <!--Edit Modal start-->
        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered ">
                <div class="modal-content" style="background-color: #2A3E4C;">
                    <form action="{{ route('contact.store') }}" id="contactForm" method="POST">
                        @csrf
                        <div class="modal-header text-white" style="border-bottom: 1px solid #1A262F;">
                            <h5 class="modal-title" id="modalTitle">Add Contact</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group  py-2 px-4">
                                        <label class="label_name ">First Name</label>
                                        <input type="text" class="form-control modal_input bg-transparent" id="first_name"
                                            name="first_name" aria-describedby="" placeholder="First name" required>
                                    </div>
                                    <div class="form-group  py-2 px-4">
                                        <label class="label_name ">Last Name</label>
                                        <input type="text" class="form-control modal_input bg-transparent" id="last_name"
                                            name="last_name" aria-describedby="" placeholder="Last name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group  py-2 px-4">
                                        <label class="label_name">Email</label>
                                        <input type="email" class="form-control modal_input bg-transparent"
                                            placeholder="Enter email" name="email" id="email" required>
                                    </div>
                                    <div class="form-group py-2 px-4">
                                        <label class="label_name ">Phone No.</label>
                                        <input type="number" id="phone"
                                            class="form-control bg-transparent modal_input" name="phone" id=""
                                            placeholder="Enter phone number" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between" style="border-top: 1px solid #1A262F;">
                            <a class="" data-bs-dismiss="modal"
                                style="color: #14AFF1; text-decoration: none;">Cancel</a>
                            <div>
                                <button type="reset" class="btn modal_btn">Reset</button>
                                <button type="submit" class="btn btn-primary mx-3" name="" id="submitBtn"
                                    style="background-color: #14AFF1;border: none;">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Edit Modal end-->
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $('#myTable').DataTable();
        });
        function editContact(contact) {
            // populate form input 
            $('#first_name').val(contact.first_name);
            $('#last_name').val(contact.last_name);
            $('#email').val(contact.email);
            $('#phone').val(contact.phone);
            $('#modalTitle').text('Update Contact');
            $('#submitBtn').text('Update');
            var url = '{{ route("contact.update", ":id") }}';
            url = url.replace(':id', contact.id);
            $('#contactForm').attr("action",url);
            $('#contactModal').modal('show');
        }
        $('#contactModal').on('hidden.bs.modal', function () {
            $('#first_name').val('');
            $('#last_name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#modalTitle').text('Add Contact');
            $('#submitBtn').text('Save');
            var url = '{{ route('contact.store') }}';
            $('#contactForm').attr("action",url);
        });
    </script>
</body>

</html>