
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright © 2020 <a href="_(( site('main') ))">_(( app_name() ))</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- Bootstrap 4 -->
@js('bootstrap/bootstrap.bundle.min')
@js('select2/select2.full.min')
@js('overlayScrollbars/js/jquery.overlayScrollbars.min')
@js('adminlte.min')
@js('dataTables/jquery.dataTables.min')
@js('dataTables/dataTables.bootstrap4.min')
<script>
    $('#tableData').DataTable();
    //Initialize Select2 Elements
    $('.select2').select2();

    if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register('/service-worker.js', {scope:'/assets/'})
      .then(response => {
        console.log('Service worker has installed!');
      }).catch(err => {
        console.log(err);
      });
    }
</script>
</body>
</html>
