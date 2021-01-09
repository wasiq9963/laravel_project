@extends('adminlayout')

@section('maincontent')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1>Product</h1>
        </div>

        <div class="col-sm-4">
          @if (Session::has('msgsuccess'))

            <p class="alert alert-success">{{Session::get('msgsuccess')}}</p>
              
          @endif
        </div>
        <div class="col-sm-4">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Validation</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add <small>Product</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url('/product/add')}}" method="POST" id="quickForm">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" name="product_name" class="form-control" value="{{old('product_name')}}" placeholder="Enter Product Name">
                  @error('product_name')
                  <p class="text-danger">*{{$message}}</p>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Product Price</label>
                    <input type="number" name="product_price" class="form-control" value="{{old('product_price')}}" placeholder="Enter Product Price">
                    @error('product_price')
                    <p class="text-danger">*{{$message}}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Category</label>
                    <select class="form-control" name="category">
                        <option value="">Select Category</option>
                        @if ($catinfo)
                            @foreach ($catinfo as $item)
                                <option value="{{$item -> id}}">{{$item -> category_name}}</option>
                                
                            @endforeach
                            
                        @endif
                    </select>
                    @error('category')
                    <p class="text-danger">*{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Brand</label>
                    <select class="form-control" name="brand" >
                        <option value="">Select Brand</option>
                        @if ($brandinfo)
                            @foreach ($brandinfo as $item)
                                <option value="{{$item -> brand_id}}">{{$item -> brand_name}}</option>
                            @endforeach
                            
                        @endif
                    </select>
                    @error('category')
                    <p class="text-danger">*{{$message}}</p>
                    @enderror
            
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">Insert</button>
                <a href="{{url('/product')}}" class="btn btn-info">Back</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
          </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection