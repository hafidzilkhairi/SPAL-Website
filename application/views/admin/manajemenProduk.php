<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo $judul; ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Admin</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah Produk</th>
                                            <th>Gambar Produk</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = $this->db->get('produk');
                                    if($query->num_rows()>0){
                                        foreach($query->result() as $value){
                                            ?> 
                                            <tr>
                                                <td><?php
                                                    $this->db->where('idAdmin',$value->idAdmin);
                                                    $this->db->select('namaAdmin');
                                                    echo $this->db->get('admin')->result()[0]->namaAdmin; ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->namaProduk;?>
                                                </td>
                                                <td>
                                                    <?php echo $value->hargaProduk;?>
                                                </td>
                                                <td>
                                                    <?php echo $value->jumlahProduk;?>
                                                </td>
                                                <td>
                                                <?php
                                                    $this->db->where('idProduk',$value->idProduk);
                                                    $gambar1 = $this->db->get('gambarProduk');
                                                    if($gambar1->num_rows()>0){
                                                        $gambar = $gambar1->result()[0];
                                                        ?>
                                                        <img style="max-height:100px;max-widht:100px;" src="<?php echo base_url().'images/produk/'.$gambar->idGambar.'.'.$gambar->extension; ?>" alt="">     
                                                        <?php
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <a href="<?php echo base_url().'admin/produk/edit/'.$value->idProduk; ?>"><button type="button" class="btn btn-info">Edit</button></a>
                                                <a href="<?php echo base_url().'admin/produk/hapus/'.$value->idProduk; ?>"></a><button type="button" class="btn btn-danger">Hapus</button>
                                                </td>
                                            </tr>
                                            <?php
                                        } 
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->