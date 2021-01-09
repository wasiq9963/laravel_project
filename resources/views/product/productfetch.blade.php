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
                  <h1 class="card-title">All Products</h1>
                </div>
                <div class="col-sm-4">
                  @if (Session::has('msgsuccess'))
        
                    <p class="alert alert-success">{{Session::get('msgsuccess')}}</p>
                      
                  @endif
                </div>
                <div class="col-sm-4">
                  <ol class="float-right">
                    <li class="breadcrumb-item"><a href="{{url('product/add')}}" class="btn btn-primary"><span class="fa fa-plus"></span> Add Product</a></li>
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
                  <th>Product Name</th>
                  <th>Product Price</th>
                  <th>Category Name</th>
                  <th>Brand Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @if ($proinfo)
                  @foreach ($proinfo as $item)
                  <tr>
                    <td>{{$item -> pro_id}}</td>
                    <td>{{$item -> product_name}}</td>
                    <td>{{$item -> price}}</td>
                    <td>{{$item -> category_name}}</td>
                    <td>{{$item -> brand_name}}</td>
                    <td>
                      <a href="{{url('/product/edit/'.$item -> pro_id)}}" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span> Edit</a>
                      <a href="#" onclick="deletefunction({{$item->pro_id}})" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                    </td>
                  </tr>
                      
                  @endforeach
                   
               @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Category Name</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                  
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
      window.location.href="{{url('product/delete')}}/"+$id;
      
    }    
  }
</script>

@endsection
@section('javascript')
    @parent
@endsection