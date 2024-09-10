<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Media Clips</h4>
                <a href="<?php echo base_url('admin/media_clips/add') ?>" class="btn btn-primary text-white float-end">New Upload</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="reports" class="table table-bordered   nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Category</th>
                                <!-- <th>Page</th> -->
                                <!-- <th>SOI(cm<sup>2</sup>)</th> -->
                                <th>Client</th>
                                <th>Title</th>
                                <!-- <th>Media House</th> -->
                                <!-- <th>Slot</th> -->
                                <!-- <th>Duration</th> -->
                                <th>..</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<script>
    $(document).ready(function() {
        $('#reports').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('AjaxDataSources/media_clips/FetchReport') ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": null
                }, // This will be for the index/serial number
                {
                    "data": "date"
                },
                {
                    "data": "category"
                },
                // {
                //     "data": "page"
                // },
                // {
                //     "data": "soi"
                // },
                {
                    "data": "client"
                },
                {
                    "data": "title"
                },
                // {
                //     "data": "media"
                // },
                // {
                //     "data": "slot"
                // },
                // {
                //     "data": "duration"
                // },
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "render": function(data, type, row) {
                        return `
                                
                                <a href="<?= base_url('admin/media_clips/view/') ?>${row.encryptedId}" ><button class="btn btn-primary btn-sm">View</button></a>
                                 <a onclick="return confirm('Are you sure?')" href="<?= base_url('admin/media_clips/delete/') ?>${row.encryptedId}"  ><button class="btn btn-danger btn-sm">Trash</button></a>
                                
                               
                          
                        `;
                    },
                    "className": "text-end"
                }
            ],
            "order": [
                [1, 'asc']
            ], // Sort by Admission Number
            "columnDefs": [{
                "targets": 0,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Add row numbering
                }
            }]
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Use event delegation to handle dynamically created .deleteclip elements
        $(document).on('click', '.deleteclip', function(e) {
            e.preventDefault();

            var val = $(this).attr('val');

            var confirm = window.confirm('Are you sure you want to delete this clip?');

            if (confirm) {
                window.location = `<?= base_url('admin/media_clips/delete') ?>/${val}`;
            }

            // console.log(val);
        });
    });
</script>


<?php echo $this->endSection(); ?>