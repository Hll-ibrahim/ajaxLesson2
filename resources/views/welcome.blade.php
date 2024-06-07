<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body >
    <div class="container">
        <div class="card m-5">
            <div class="card-header">Form</div>
            <div class="card-body">
                <form id="form">
                    <input type="text" name="name" class="form-select my-2" placeholder="name">
                    <input type="text" name="age" class="form-select my-2" placeholder="age">
                    <input type="text" name="weight" class="form-select my-2" placeholder="weight">
                    <input type="text" name="height" class="form-select my-2" placeholder="height">
                </form>
                <button onclick="post()" class="btn btn-success">Post</button>
            </div>
        </div>
        <div class="container my-3">
            @foreach($people as $person)
                {{$person->name}}
            @endforeach
        </div>
        <div class="card">
            <table class="table table-bordered" id="UsersTable_id">
                <thead>
                <tr>
                    <th>#</th>
                    <th>yaş</th>
                    <th>boy</th>
                    <th>kilo  Numarası</th>
                    <th>GÜncelle</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>





    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="ModalLabel" class="fw-bolder mt-3">Departman Seçimi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="input-group mt-3" style="width: 300px; margin-left: 20px;">
                    <input class="form-control" id="updateId">
                </div>

                <div id="allDepartments" class="mb-3">
                    <ul class="list-group list-group-light" id="allDepartmentsParents">

                    </ul>
                </div>
                <button onclick="addDepartmentPost()" class="btn btn-success">Ekle</button>
            </div>
        </div>
    </div>

    </body>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    function post(){
        var data = new FormData(document.getElementById('form'))
        $.ajax({
            url: '{{route('post')}}',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            method: 'post',
            headers: {'X-CSRF-TOKEN': "{{csrf_token()}} "},
            dataType: 'json',
            success: function(response){
                console.log(response);
            },// controller dan gelen fonksiyonların yakalandığı yer
            error: function(response){
                console.log(response.responseJSON.message);
            },
        })
    }

    $(document).ready(function() {
        $('#UsersTable_id').DataTable();
    });

    var dataTable = $('#UsersTable_id').DataTable({
        language: {
            url: '{{ asset('/lang/tr.json') }}',
        },
        proccessing:true,
        serverSide:true,
        ajax:"{{route('fetch')}}",

        columns:[
            {data: 'name'},
            {data: 'age'},
            {data: 'height'},
            {data: 'weight'},
            {data: 'update'},
        ]
    });

    function update(id){
        $('#updateModal').modal('show');
        $('#updateId').val(id);

    }

</script>



</html>
