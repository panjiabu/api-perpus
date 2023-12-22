<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Data Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Data Buku</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addBookModal"><i class="fas fa-plus"></i> Tambah Buku</button>
    <table id="bukuTable" class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be inserted here using JavaScript -->
        </tbody>
    </table>
</div>

<!-- Modal for Adding Book -->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addBookForm">
                    <div class="form-group">
                        <label for="judul">Judul:</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis:</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit:</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit:</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#bukuTable').DataTable({
            ajax: {
                url: '/api/buku', // Replace with your API endpoint
                dataSrc: 'list_buku'
            },
            columns: [
                { data: 'id_buku' },
                { data: 'judul' },
                { data: 'penulis' },
                { data: 'penerbit' },
                { data: 'tahun_terbit' },
                { data: 'harga' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<button class="btn btn-danger" onclick="deleteBook(' + data.id_buku + ')"><i class="fas fa-trash"></i> Delete</button>';
                    }
                }
            ]
        });

        // Function to handle book deletion
        window.deleteBook = function (bookId) {
            // Implement your logic to delete the book
            // You can use AJAX to call the delete API endpoint
            // After deletion, refresh the DataTable
            alert('Implement delete logic for book ID: ' + bookId);
            // Example:
            // $.ajax({
            //     url: '/api/buku/' + bookId,
            //     type: 'DELETE',
            //     success: function () {
            //         table.ajax.reload();
            //     }
            // });
        };

        // Submit form using Ajax for adding a new book
        $('#addBookForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '/api/buku',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    // Close the modal and refresh the DataTable
                    $('#addBookModal').modal('hide');
                    table.ajax.reload();
                    // Optionally, you can display a success message
                    alert('Book added successfully!');
                },
                error: function (xhr, status, error) {
                    // Handle errors here
                    alert('Error adding book: ' + error);
                }
            });
        });
    });
</script>

</body>
</html>
