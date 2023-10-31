
@extends('master')
@section('section')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Type handicap</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header   -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

        @if(session('success'))
         <div class="alert alert-success">
        {{ session('success') }}
         </div>
           @endif  

            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-12 d-flex justify-content-between p-0">
                        <div class="d-flex justify-content-between">
                            <a href="{{route('typeHandicap.create')}}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                        <div class="card-tools">
                            
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <!-- SEARCH input -->
                                    <input type="text" name="search" id="searchInput" class="form-control float-right" placeholder="Search">                             
                            </div>
                          </div>
                
               

                    </div>
                </div>
  

           
                <div class="card-body p-0 table-data">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 100px">Id</th>
                                <th style="width: 400px">Type handicap</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody id="result-table">

             
                    @foreach ($data as $value)
                

            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->nom}} </td>
                <td>{{$value->description}} </td>



                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{route('typeHandicap.show', $value->id)}}">
                        <i class="fas fa-folder">
                        </i>
                        Afficher
                    </a>
                    <a class="btn btn-info btn-sm" href="{{route('typeHandicap.edit', $value->id)}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Modifier
                    </a>
                    <form class style="display: contents"
                        action="{{route('typeHandicap.destroy', $value->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger btn-sm" href="#">
                            <i class="fas fa-trash">
                            </i>
                            Supprimer
                        </button>
                    </form>


                </td>
            </tr>
            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>




                <!-- Pagination Links -->
<div class="card-footer clearfix text-center" id="pagination-container">
    {{$data->links()}}
</div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- result-table --}}
<script>

$(document).ready(function() {
    $('#searchInput').keyup(function() {
        var keyword = $(this).val();
        $.ajax({
            url: '/search-handicap', // URL should match the route where searchHandicap method is defined
            type: 'GET',
            data: { search: keyword },
            success: function(response) {
                // Clear existing table rows
                $('#result-table').empty();
                
                // Iterate through the response data and append new rows to the table
                $.each(response.data, function(index, value) {
                    var actionsHtml = '<td class="project-actions text-right">' +
                    '<a class="btn btn-primary btn-sm" href="{{ route('typeHandicap.show', $value->id) }}">' +
                    '<i class="fas fa-folder"></i> Afficher' +
                    '</a>' +
                    '<a class="btn btn-info btn-sm" href="{{ route('typeHandicap.edit', $value->id) }}">' +
                    '<i class="fas fa-pencil-alt"></i> Modifier' +
                    '</a>' +
                    '<form style="display: inline-block;" action="{{ route('typeHandicap.destroy', $value->id) }}" method="post">' +
                    '@csrf' +
                    '@method("DELETE")' +
                    '<button type="submit" class="btn btn-danger btn-sm">' +
                    '<i class="fas fa-trash"></i> Supprimer' +
                    '</button>' +
                    '</form>' +
                    '</td>';

                    var newRow = '<tr>' +
                    '<td>' + value.id + '</td>' +
                    '<td>' + value.nom + '</td>' +
                    '<td>' + value.description + '</td>' +
                    actionsHtml + // Include the actions HTML here
                    '</tr>';
                    $('#result-table').append(newRow);
                    });


                $('#pagination-container').html(response.links);
                console.log(response.links);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

</script>



@endsection