@extends('adminlayout')

@section('maincontent')

  <!-- Main content -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-4">
                  <h1 class="card-title">Categories</h1>
                </div>
                <div class="col-sm-4">
                  @if (Session::has('msgsuccess'))
        
                    <p class="alert alert-success">{{Session::get('msgsuccess')}}</p>
                      
                  @endif
                </div>
                <div class="col-sm-4">
                  <ol class="float-right">
                    <li class="breadcrumb-item"><a href="{{url('category/add')}}" class="btn btn-primary"><span class="fa fa-plus"></span> Add Category</a></li>
                  </ol>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @if ($catinfo)
                  @foreach ($catinfo as $item)
                  <tr>
                    <td>{{$item -> id}}</td>
                    <td>{{$item -> category_name}}</td>
                    <td>
                      <a href="{{url('/category/edit/'.$item->id)}}" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span> Edit</a>
                      <a href="#" onclick="deletefunction({{$item->id}})" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                    </td>
                  </tr>
                      
                  @endforeach
                   
               @endif
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Category Name</th>
                  
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
    
<script>
  function deletefunction($id) 
  {
    if (confirm('Are you sure yiu want to delete?')) 
    {
      window.location.href="{{url('category/delete')}}/"+$id;
      
    }    
  }
</script>

@endsection

@section('javascript')
    @parent
@endsection