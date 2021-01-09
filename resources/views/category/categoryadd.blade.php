@extends('adminlayout')

@section('maincontent')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1>Category</h1>
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
              <h3 class="card-title">Add <small>Category</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url('/category/add')}}" method="POST" id="quickForm">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" name="catname" class="form-control" value="{{old('catname')}}" id="exampleInputEmail1" placeholder="Enter Category">
                  @error('catname')
                  <p class="text-danger">*{{$message}}</p>
                  @enderror
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{url('category')}}" class="btn btn-info"> Back</a>
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