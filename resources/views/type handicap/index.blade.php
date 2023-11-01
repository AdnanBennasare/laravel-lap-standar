
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
    var query = '';
    var page = 1;

    // Function to update the URL
    function updateUrl() {
        var url = '/search-handicap?query=' + query + '&page=' + page;
        history.pushState({ path: url }, '', url);
    }

    $('#searchInput').keyup(function() {
        query = $(this).val();
        page = 1;
        updateUrl();

        var url = '/search-handicap?query=' + query + '&page=' + page;

        $.ajax({
            url: url,
            type: 'GET',
            data: { search: query },
            success: function(response) {
                console.log(response);
                
// Clear existing table rows
               $('#result-table').empty();
               
               // Iterate through the response data and append new rows to the table
               $.each(response.data, function(index, value) {
               var showUrl = showRoute.replace(':id', value.id);
               var editUrl = editRoute.replace(':id', value.id);
               var deleteUrl = deleteRoute.replace(':id', value.id);

               var actionsHtml = '<td class="project-actions text-right">' +
               '<a class="btn btn-primary btn-sm" href="' + showUrl + '">' +
               '<i class="fas fa-folder"></i> Afficher' +
               '</a>' +
               '<a class="btn btn-info btn-sm" href="' + editUrl + '">' +
               '<i class="fas fa-pencil-alt"></i> Modifier' +
               '</a>' +
               '<form style="display: inline-block;" action="' + deleteUrl + '" method="post">' +
               '<input type="hidden" name="_token" value="' + csrfToken + '">' +
               '<input type="hidden" name="_method" value="DELETE">' +
               '<button type="submit" class="btn btn-danger btn-sm">' +
               '<i class="fas fa-trash"></i> Supprimer' +
               '</button>' +
               '</form>' +
               '</td>';

               var newRow = '<tr>' +
               '<td>' + value.id + '</td>' +
               '<td>' + value.nom + '</td>' +
               '<td>' + value.description + '</td>' +
               actionsHtml +
               '</tr>';

               $('#result-table').append(newRow);
               });



               $('#pagination-container').html(response.links);
               console.log(response.links);

                // Handle the response data here
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

        $(document).on('click', '#pagination-container a', function(event) {
        event.preventDefault();
        var href = new URL($(this).attr('href'));
        var targetPage = href.searchParams.get('page');
        page = targetPage;
        updateUrl();

        var url = '/search-handicap?query=' + query + '&page=' + page;

        $.ajax({
            url: url,
            type: 'GET',
            data: { query: query, page: page },
            success: function(response) {
                // Clear existing table rows
               $('#result-table').empty();
               
               // Iterate through the response data and append new rows to the table
               $.each(response.data, function(index, value) {
               var showUrl = showRoute.replace(':id', value.id);
               var editUrl = editRoute.replace(':id', value.id);
               var deleteUrl = deleteRoute.replace(':id', value.id);

               var actionsHtml = '<td class="project-actions text-right">' +
               '<a class="btn btn-primary btn-sm" href="' + showUrl + '">' +
               '<i class="fas fa-folder"></i> Afficher' +
               '</a>' +
               '<a class="btn btn-info btn-sm" href="' + editUrl + '">' +
               '<i class="fas fa-pencil-alt"></i> Modifier' +
               '</a>' +
               '<form style="display: inline-block;" action="' + deleteUrl + '" method="post">' +
               '<input type="hidden" name="_token" value="' + csrfToken + '">' +
               '<input type="hidden" name="_method" value="DELETE">' +
               '<button type="submit" class="btn btn-danger btn-sm">' +
               '<i class="fas fa-trash"></i> Supprimer' +
               '</button>' +
               '</form>' +
               '</td>';

               var newRow = '<tr>' +
               '<td>' + value.id + '</td>' +
               '<td>' + value.nom + '</td>' +
               '<td>' + value.description + '</td>' +
               actionsHtml +
               '</tr>';

               $('#result-table').append(newRow);
               });



               $('#pagination-container').html(response.links);
               console.log(response.links);
               
                // Handle the response data here
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});




// $(document).ready(function() {
//     var query = ''; // Declare query outside the event handlers
//     var page = 1;   // Declare page outside the event handlers
    
//     $('#searchInput').keyup(function() {
//         query = $(this).val();
//         page = 1; // Reset page number to 1 when the search query changes

//         // Function to update the URL
//         function updateUrl() {
//             var url = '/search-handicap?query=' + query + '&page=' + page;
//             history.pushState({ path: url }, '', url);
//         }

//         var url = '/search-handicap?query=' + query + '&page=' + page;
        
//         history.pushState({path: url}, '', url); // Update the URL without page reload
        
//         $.ajax({
//             url: url,
//             type: 'GET',
//             data: { search: query },
//             success: function(response) {
//                 console.log(response);

// // Clear existing table rows
//                $('#result-table').empty();
               
//                // Iterate through the response data and append new rows to the table
//                $.each(response.data, function(index, value) {
//                var showUrl = showRoute.replace(':id', value.id);
//                var editUrl = editRoute.replace(':id', value.id);
//                var deleteUrl = deleteRoute.replace(':id', value.id);

//                var actionsHtml = '<td class="project-actions text-right">' +
//                '<a class="btn btn-primary btn-sm" href="' + showUrl + '">' +
//                '<i class="fas fa-folder"></i> Afficher' +
//                '</a>' +
//                '<a class="btn btn-info btn-sm" href="' + editUrl + '">' +
//                '<i class="fas fa-pencil-alt"></i> Modifier' +
//                '</a>' +
//                '<form style="display: inline-block;" action="' + deleteUrl + '" method="post">' +
//                '<input type="hidden" name="_token" value="' + csrfToken + '">' +
//                '<input type="hidden" name="_method" value="DELETE">' +
//                '<button type="submit" class="btn btn-danger btn-sm">' +
//                '<i class="fas fa-trash"></i> Supprimer' +
//                '</button>' +
//                '</form>' +
//                '</td>';

//                var newRow = '<tr>' +
//                '<td>' + value.id + '</td>' +
//                '<td>' + value.nom + '</td>' +
//                '<td>' + value.description + '</td>' +
//                actionsHtml +
//                '</tr>';

//                $('#result-table').append(newRow);
//                });



//                $('#pagination-container').html(response.links);
//                console.log(response.links);

//             },
//             error: function(error) {
//                 console.log(error);
//             }
//         });
//     });



//     // Event listener for pagination links
//     $(document).on('click', '#pagination-container a', function(event) {
//         event.preventDefault();
//         var targetPage = $(this).attr('href').split('page=')[1];
//         page = targetPage; // Update the page number based on the clicked pagination link
//         updateUrl(); // Update the URL with the new page number
        
//         // Make the AJAX request with the updated URL
//         $.ajax({
//             url: '/search-handicap',
//             type: 'GET',
//             data: { query: query, page: page },
//             success: function(response) {
//                 // Handle the response data here
//             },
//             error: function(error) {
//                 console.log(error);
//             }
//         });
//     });
// });
// </script>


<script>
    var showRoute = "{{ route('typeHandicap.show', ':id') }}";
    var editRoute = "{{ route('typeHandicap.edit', ':id') }}";
    var deleteRoute = "{{ route('typeHandicap.destroy', ':id') }}";
    var csrfToken = "{{ csrf_token() }}";
</script>



































{{-- $(document).ready(function() {
    $('#searchInput').keyup(function() {
        var keyword = $(this).val();
        console.log(keyword)


    // Function to update the URL
    function updateUrl() {
        var url = '/search-handicap?query=' + query + '&page=' + page;
        history.pushState({ path: url }, '', url);
    }

        var page = 1; // You can set the initial page number to 1
        var url = '/search-handicap?query=' + keyword + '&page=' + page;
        
        history.pushState({path: url}, '', url); // Update the URL without page reload
        
        $.ajax({
            url: url,
            type: 'GET',
            data: { search: keyword },
            success: function(response) {
                console.log(response)

 // Clear existing table rows
                $('#result-table').empty();
                
                // Iterate through the response data and append new rows to the table
                $.each(response.data, function(index, value) {
                var showUrl = showRoute.replace(':id', value.id);
                var editUrl = editRoute.replace(':id', value.id);
                var deleteUrl = deleteRoute.replace(':id', value.id);

                var actionsHtml = '<td class="project-actions text-right">' +
                '<a class="btn btn-primary btn-sm" href="' + showUrl + '">' +
                '<i class="fas fa-folder"></i> Afficher' +
                '</a>' +
                '<a class="btn btn-info btn-sm" href="' + editUrl + '">' +
                '<i class="fas fa-pencil-alt"></i> Modifier' +
                '</a>' +
                '<form style="display: inline-block;" action="' + deleteUrl + '" method="post">' +
                '<input type="hidden" name="_token" value="' + csrfToken + '">' +
                '<input type="hidden" name="_method" value="DELETE">' +
                '<button type="submit" class="btn btn-danger btn-sm">' +
                '<i class="fas fa-trash"></i> Supprimer' +
                '</button>' +
                '</form>' +
                '</td>';

                var newRow = '<tr>' +
                '<td>' + value.id + '</td>' +
                '<td>' + value.nom + '</td>' +
                '<td>' + value.description + '</td>' +
                actionsHtml +
                '</tr>';

                $('#result-table').append(newRow);
                });



                $('#pagination-container').html(response.links);
                console.log(response.links);

                console.log(response.links)


                // Handle the response data here
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});






$(document).ready(function() {
    // Initial search query and page number
    var query = '';
    var page = 1;

    // Function to update the URL
    function updateUrl() {
        var url = '/search-handicap?query=' + query + '&page=' + page;
        history.pushState({ path: url }, '', url);
    }

    // Event listener for pagination links
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var targetPage = $(this).attr('href').split('page=')[1];
        page = targetPage; // Update the page number based on the clicked pagination link
        updateUrl(); // Update the URL with the new page number
        
        // Make the AJAX request with the updated URL
        $.ajax({
            url: '/search-handicap',
            type: 'GET',
            data: { query: query, page: page },
            success: function(response) {
                // Handle the response data here
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

</script>

<script>
    var showRoute = "{{ route('typeHandicap.show', ':id') }}";
    var editRoute = "{{ route('typeHandicap.edit', ':id') }}";
    var deleteRoute = "{{ route('typeHandicap.destroy', ':id') }}";
    var csrfToken = "{{ csrf_token() }}";
</script> --}}

{{-- <script>

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
                var showUrl = showRoute.replace(':id', value.id);
                var editUrl = editRoute.replace(':id', value.id);
                var deleteUrl = deleteRoute.replace(':id', value.id);

                var actionsHtml = '<td class="project-actions text-right">' +
                '<a class="btn btn-primary btn-sm" href="' + showUrl + '">' +
                '<i class="fas fa-folder"></i> Afficher' +
                '</a>' +
                '<a class="btn btn-info btn-sm" href="' + editUrl + '">' +
                '<i class="fas fa-pencil-alt"></i> Modifier' +
                '</a>' +
                '<form style="display: inline-block;" action="' + deleteUrl + '" method="post">' +
                '<input type="hidden" name="_token" value="' + csrfToken + '">' +
                '<input type="hidden" name="_method" value="DELETE">' +
                '<button type="submit" class="btn btn-danger btn-sm">' +
                '<i class="fas fa-trash"></i> Supprimer' +
                '</button>' +
                '</form>' +
                '</td>';

                var newRow = '<tr>' +
                '<td>' + value.id + '</td>' +
                '<td>' + value.nom + '</td>' +
                '<td>' + value.description + '</td>' +
                actionsHtml +
                '</tr>';

                $('#result-table').append(newRow);
                });



                $('#pagination-container').html(response.links);
                console.log(response.links);

                console.log(response.links)
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

</script>
<script>
    var showRoute = "{{ route('typeHandicap.show', ':id') }}";
    var editRoute = "{{ route('typeHandicap.edit', ':id') }}";
    var deleteRoute = "{{ route('typeHandicap.destroy', ':id') }}";
    var csrfToken = "{{ csrf_token() }}";
</script> --}}





@endsection