<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo $judul; ?></strong>
                            </div>
                            <div class="card-body">
                                <?php
                                if($this->session->flashdata('editGambarProduk')==1){
                                    ?>
                                <div class="alert alert-success" role="alert">
                                Edit produk sukses!!!
                                </div>
                                    <?php
                                }else if($this->session->flashdata('editGambarProduk')==2){
                                    ?>
                                <div class="alert alert-danger" role="alert">
                                Edit produk gagal!!!
                                </div>
                                    <?php
                                }
                                ?>
                                <div class="col-md-6">
                                    <img id="image_upload_preview" src="https://via.placeholder.com/600">
                                </div>
                                <div class="col-md-6">
                                        <?php echo validation_errors(); ?>

                                        <?php echo form_open_multipart('admin/produk/tambah/upload');?>
                                        <div class="form-group">
                                            <label>Nama Produk</label>
                                            <input name="namaProduk" type="text" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Harga Produk</label>
                                                <input name="hargaProduk" type="number" class="form-control" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>jumlah Produk</label>
                                                <input name="jumlahProduk" type="number" class="form-control" min="0" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gambar Produk</label>
                                            <input name="gambarProduk" id="inputFile" type="file" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi Produk</label>
                                            <textarea name="deskripsiProduk" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                        <button type="submit"    class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

    <script>
    $(document).ready(() => {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload_preview').attr('src',e.target.result);
                    // alert(e.target.result);
                    // window.location.replace(e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputFile").change(function () {
            readURL(this);
        });
    });
    </script>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->