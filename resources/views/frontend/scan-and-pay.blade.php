@extends('frontend.layouts.app')
@section('title', 'Scan and pay')
@section('content') 
        <section class="scan-and-pay my-4">
            <div class="card">
              @error('Fail')
              <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                {{$message}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
              @enderror
                <div class="card-body text-center">
                    <img src="{{asset('img/qr-scan.png')}}" class="img-fluid" width="200">
                    <div class="text-center">Scan QR and pay</div>
                    <div class="mt-3">
                        <button class="btn btn-theme" data-toggle="modal" data-target="#scanModal">Scan</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="scanModalLabel">Scan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <video width="100%" id="scanVideo"></video>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('scripts')
<script src="{{asset('frontend/js/instascan.min.js')}}"></script>
<script>
    $(document).ready(function() {
    // let scanner = new Instascan.Scanner({ video: document.getElementById('scanVideo') });
    // const instascan = require('instascan');
    const args = { video: document.getElementById('scanVideo') };
    window.URL.createObjectURL = (stream) => {
            args.video.srcObject = stream;
            return stream;
    };
    const scanner = new Instascan.Scanner(args);
    
    scanner.addListener('scan', function (content) {
        if (content) {
            Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
              scanner.stop(cameras[0]);
            } else {
              console.error('No cameras found.');
            }
            }).catch(function (e) {
                console.error(e);
            });
            $('#scanModal').hide();
            $(document.body).removeClass('modal-open');
            $('.modal-backdrop').remove();
            window.location.replace('scan-and-pay/form?to_phone='+content);
        }
        
      });

      $('#scanModal').on('shown.bs.modal', function (event) {
          Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
              scanner.start(cameras[0]);
            } else {
              console.error('No cameras found.');
            }
            }).catch(function (e) {
            console.error(e);
            });
        })

      $('#scanModal').on('hidden.bs.modal', function (event) {
          Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
              scanner.stop(cameras[0]);
            } else {
              console.error('No cameras found.');
            }
            }).catch(function (e) {
                console.error(e);
            });
        })

      // Instascan.Camera.getCameras().then(function (cameras) {
      //   if (cameras.length > 0) {
      //     scanner.start(cameras[0]);
      //   } else {
      //     console.error('No cameras found.');
      //   }
      // }).catch(function (e) {
      //   console.error(e);
      // });
    })
</script>

@endsection
