<!-- Babel polyfill, contains Promise -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.6.15/browser-polyfill.min.js"></script>

<!-- Get FilePond polyfills from the CDN -->
<script src="https://unpkg.com/filepond-polyfill/dist/filepond-polyfill.js"></script>

<!-- Get FilePond JavaScript and its plugins from the CDN -->
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
</script>
<script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>

<!-- ####################################### FilePond Footer #################################### -->

<!-- FilePond init script -->
<script>
  // Register plugins

  function getImageSrc(selector){ 
    var collectHtml="";
    var files = selector.getFiles();
    for(i in files){
      var item = files[i];    
      collectHtml +=item.serverId;
    }
    return collectHtml;
  }

  


  const PondManager = {
    list : [],

    init : ()=>{
// Register plugins
FilePond.registerPlugin(
  FilePondPluginFileValidateSize,
  FilePondPluginImageExifOrientation,
  FilePondPluginImageCrop,
  FilePondPluginImageResize,
  FilePondPluginImagePreview,
  FilePondPluginImageTransform
  );

    // Set default FilePond options
    FilePond.setOptions({
      // maximum allowed file size
      maxFileSize: '500MB',
      imagePreviewHeight: 150,
      imagePreviewWidth: 150,
      /*       imageResizeTargetWidth: 45,
      imageResizeTargetHeight: 45,*/
      instantUpload: true,
      // crop the image to a 1:1 ratio
      imageCropAspectRatio: '1:1',
      // upload to this server end point
      server:{
        process:'{{ url("/filepond/uploadImage?_method=get") }}',
        revert: '/filepond/deleteImage?_method=DELETE&_token=<?php echo csrf_token(); ?>'
      }

    });
    
    $('input[name="image"]').each((key,each)=>{
      let element = FilePond.create(each);
      PondManager.list.push(element);
    });
    // PondManager.list = PondManager.list.filter(x=>x.getFiles()!="")
    // console.log(PondManager.list);
  },
  interval : ()=>{
    setInterval(function(){
      PondManager.list.filter(x=>x.getFiles()!="").forEach((each,key)=> {
        let imageName = getImageSrc(each);
        imageName  = imageName ? imageName : "";
        $('#image_'+key).val(imageName);
      });

    },2000);
  }
};

PondManager.interval();
PondManager.init();


</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin-lte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->

<script src="{{ asset('admin-lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('admin-lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin-lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-lte/dist/js/adminlte.js') }}"></script>
<!-- MdTimepicker -->
<script src="{{ asset('admin-lte/js/mdtimepicker.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-lte/dist/js/adminlte.min.js') }}"></script>
<!-- FullCalendar -->
<!-- fullCalendar 2.2.5 -->

<script src="{{ asset('plugins/fullcalendar/js/moment.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>

<!-- File Pond Configration -->
<script>
  $(document).ready(function($) {

    /* Javascript Code Here*/
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@stack('script')