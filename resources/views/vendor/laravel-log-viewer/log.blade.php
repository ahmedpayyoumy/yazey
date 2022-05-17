{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Log Viewer')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <style>
      h1 {
        font-size: 1.5em;
        margin-top: 0;
      }

      #table-log {
          font-size: 0.85rem;
      }

      .sidebar {
          font-size: 0.85rem;
          line-height: 1;
      }

      .btn {
          font-size: 0.7rem;
      }

      .stack {
        font-size: 0.85em;
      }

      .date {
        min-width: 75px;
      }

      .text {
        word-break: break-all;
      }

      a.llv-active {
        z-index: 2;
        background-color: #f5f5f5;
      }

      .list-group-item {
        word-break: break-word;
      }

      .folder {
        padding-top: 15px;
      }

      .div-scroll {
        height: 80vh;
        overflow: hidden auto;
      }
      .nowrap {
        white-space: nowrap;
      }

    </style>
@endsection

{{-- Content --}}
@section('content')

    <div class="d-flex flex-column-fluid">
      <div class="card card-custom w-100">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
              <div class="card-title">
                  Log Viewer
              </div>
          </div>
          <div class="card-body row" style="padding-top: 0px;">
              <div class="col-md-2">
                  <div class="list-group div-scroll">
                    @foreach($folders as $folder)
                      <div class="list-group-item">
                        <a href="?f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}">
                          <span class="fa fa-folder"></span> {{$folder}}
                        </a>
                        @if ($current_folder == $folder)
                          <div class="list-group folder">
                            @foreach($folder_files as $file)
                              <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}&f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}"
                                class="list-group-item @if ($current_file == $file) llv-active @endif">
                                {{$file}}
                              </a>
                            @endforeach
                          </div>
                        @endif
                      </div>
                    @endforeach
                    @foreach($files as $file)
                      <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                          class="list-group-item @if ($current_file == $file) llv-active @endif">
                        {{$file}}
                      </a>
                    @endforeach
                  </div>
              </div>
              <div class="col-md-10">
                  @if ($logs === null)
                    <div>
                      Log file >50M, please download it.
                    </div>
                  @else
                    <table id="table-log" class="table table-striped table-container" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
                      <thead>
                      <tr>
                        @if ($standardFormat)
                          <th>Level</th>
                          <th>Context</th>
                          <th>Date</th>
                        @else
                          <th>Line number</th>
                        @endif
                        <th>Content</th>
                      </tr>
                      </thead>
                      <tbody>

                      @foreach($logs as $key => $log)
                        <tr data-display="stack{{{$key}}}">
                          @if ($standardFormat)
                            <td class="nowrap text-{{{$log['level_class']}}}">
                              <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                            </td>
                            <td class="text">{{$log['context']}}</td>
                          @endif
                          <td class="date">{{{$log['date']}}}</td>
                          <td class="text">
                            @if ($log['stack'])
                              <button type="button"
                                      class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                      data-display="stack{{{$key}}}">
                                <span class="fa fa-search"></span>
                              </button>
                            @endif
                            {{{$log['text']}}}
                            @if (isset($log['in_file']))
                              <br/>{{{$log['in_file']}}}
                            @endif
                            @if ($log['stack'])
                              <div class="stack" id="stack{{{$key}}}"
                                    style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endforeach

                      </tbody>
                    </table>
                  @endif
                  <div class="p-3">
                    @if($current_file)
                      <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                        <span class="fa fa-download"></span> Download file
                      </a>
                      -
                      <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                        <span class="fa fa-sync"></span> Clean file
                      </a>
                      -
                      <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                        <span class="fa fa-trash"></span> Delete file
                      </a>
                      @if(count($files) > 1)
                        -
                        <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                          <span class="fa fa-trash-alt"></span> Delete all files
                        </a>
                      @endif
                    @endif
                  </div>

              </div>
          </div>
      </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>

      $(document).ready(function () {
        $('.table-container tr').on('click', function () {
          $('#' + $(this).data('display')).toggle();
        });
        $('#table-log').DataTable({
          "responsive": true,
          "lengthChange": false,
          "order": [$('#table-log').data('orderingIndex'), 'desc'],
          "stateSave": true,
          "stateSaveCallback": function (settings, data) {
            window.localStorage.setItem("datatable", JSON.stringify(data));
          },
          "stateLoadCallback": function (settings) {
            var data = JSON.parse(window.localStorage.getItem("datatable"));
            if (data) data.start = 0;
            return data;
          }
        });
        $('#delete-log, #clean-log, #delete-all-log').click(function (e) {
          // return confirm('Are you sure?');
          e.preventDefault();
          let that = $(this);
          swal.fire({
                title: "Are you sure?",
                text: "This operation will not be unrecoverable ",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    swal.fire(
                        "Đã xóa!",
                        "",
                        "success"
                    )
                    window.location.href = that.attr('href');
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Đã huỷ",
                        ":)",
                        "error"
                    )
                    return false;
                }
            });

        });
      });
    </script>

@endsection


<!-- Datatables -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->


<!-- </body>
</html> -->
