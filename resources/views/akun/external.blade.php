 @extends('layouts.main')

 @section('content')
     <!-- About Section -->
     {{-- content --}}
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">External</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">External</li>
                     </ol>
                 </div>
             </div>
         </div>
     </div>
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h3 class="card-title">External Akun</h3>
                         </div>
                         <div class="card-body">
                             <table id="example1" class="table table-bordered table-hover">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th>Level</th>
                                         <th>Area</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($dataKar as $index => $dataKar)
                                         <tr>
                                             <td>{{ $index + 1 }}</td>
                                             <td>{{ $dataKar->nama }}</td>
                                             <td>{{ $dataKar->email }}</td>
                                             <td>{{ $dataKar->level }}</td>
                                             <td>
                                                 @if ($dataKar->area == true)
                                                     {{ $dataKar->area }}
                                                 @elseif ($dataKar->area == false)
                                                     -
                                                 @endif
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- Modal -->
 @endsection

 @section('scripts')
 @endsection
