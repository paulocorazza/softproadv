<section class="col-lg-12 col-12 connectedSortable ui-sortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Gráfico Finaceiro
            </h3>

        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                {!! $financialChart->container() !!}
            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>



