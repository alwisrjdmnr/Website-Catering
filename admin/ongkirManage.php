<div class="container-fluid" style="margin-top:98px">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="partials/_ongkirManage.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(111 202 203);">
                            Buat Tujuan Ongkir
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Nama Kota: </label>
                                <input type="text" class="form-control" name="city" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ongkir: </label>
                                <input type="text" class="form-control" name="cost" required>
                            </div> 
                        </div>  
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="createOngkir" class="btn btn-sm btn-success col-sm-3 offset-md-4"> Tambah </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->
    
            <!-- Table Panel -->
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                    <table class="table table-bordered table-hover mb-0">
                        <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th class="text-center" style="width:7%;">Id</th>
                            <th class="text-center" style="width:50%;">Kota Tujuan</th>
                            <th class="text-center">Ongkir</th>
                            <th class="text-center" style="width:18%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = "SELECT * FROM `ongkir`"; 
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $catId = $row['id'];
                                $catName = $row['city'];
                                $catDesc = $row['cost'];

                                echo '<tr>
                                        <td class="text-center"><b>' .$catId. '</b></td>
                                        <td>'. $catName  .'</td>
                                        <td>'. $catDesc  .'</td>
                                        <td class="text-center">
                                            <div class="row mx-auto" style="width:112px">
                                            <button class="btn btn-sm btn-success edit_cat" type="button" data-toggle="modal" data-target="#updateCat' .$catId. '">Edit</button>
                                            <form action="partials/_ongkirManage.php" method="POST">
                                                <button name="removeOngkir" class="btn btn-sm btn-danger" style="margin-left:9px;">Hapus</button>
                                                <input type="hidden" name="catId" value="'.$catId. '">
                                            </form></div>
                                        </td>
                                    </tr>';
                            }
                        ?> 
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>	    
</div>


<?php 
    $catsql = "SELECT * FROM `ongkir`";
    $catResult = mysqli_query($conn, $catsql);
    while($catRow = mysqli_fetch_assoc($catResult)){
        $catId = $catRow['id'];
        $catName = $catRow['city'];
        $catDesc = $catRow['cost'];
?>

<!-- Modal -->
<div class="modal fade" id="updateCat<?php echo $catId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateCat<?php echo $catId; ?>" aria-hidden="true" style="width: -webkit-fill-available;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="updateCat<?php echo $catId; ?>">Id Ongkir: <b><?php echo $catId; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_ongkirManage.php" method="post">
            <div class="text-left my-2">
                <b><label for="name">Kota Tujuan</label></b>
                <input class="form-control" id="name" name="city" value="<?php echo $catName; ?>" type="text" required>
            </div>
            <div class="text-left my-2">
                <b><label for="desc">Ongkir</label></b>
                 <input class="form-control" id="cost" name="cost" value="<?php echo $catDesc; ?>" type="text" required>
            </div>
            <input type="hidden" id="catId" name="catId" value="<?php echo $catId; ?>">
            <button type="submit" class="btn btn-success" name="updateOngkir">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>