@extends('admin.layouts.app')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('password_status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('password_status') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! Session('error') !!}</strong>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-sm-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Update Intiqal
                            <span class="panel-subtitle"></span>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <form action="{{ route('save.intiqal') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="" class="text-primary">Intiqal#</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                                                    <input type="text" placeholder="0" required value="{{ old('intiqal_no') }}" class="form-control" id="intiqal_no" name="intiqal_no">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="text-primary">Intiqal
                                                </label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="text" required placeholder="0" value="{{ old('intiqal') }}" class="form-control" id="" name="intiqal">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="intiqal_attachment" class="text-primary">Intiqal Attachment</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="file" required value="{{ old('intiqal_attachment') }}" class="form-control" id="intiqal_attachment" name="intiqal_attachment">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="" class="text-primary">Description</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="text" required value="{{ old('description') }}" class="form-control" id="description" name="description">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <br><br>
                                                <button class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-body">
                            <center>  <h1 style="font-family: Emoji,serif;  background-color: lightgray;color: black;" class="test text-uppercase">Intiqal List</h1></center>
                            <div class="row invoice-data" style="margin-bottom:0;">
                                <div class="col-xs-12 invoice-person">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr >
                                                    <th class="text-center">Sr#</th>
                                                    <th class="text-center">Intiqal#</th>
                                                    <th class="text-center">Intiqal </th>
                                                    <th class="text-center">Intiqal Attachment</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($intiqals as $intiqal)
                                                    <tr>
                                                        <td class="text-center">{{ $counter++ }}</td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            // App.init();
            App.dataTables();
        });
    </script>
@endsection

