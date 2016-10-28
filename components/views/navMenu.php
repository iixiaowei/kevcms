<?php
$sql = "select * from {{%tbl_menu}} where parentid=0 order by listorder desc";
$cmd=\Yii::$app->db->createCommand($sql);
$results  = $cmd->queryAll();
$i=1;
foreach($results as $rs):
    $id=$rs['id'];
    $sql = "select count(id) as cnt from {{%tbl_menu}} where parentid=:parentid order by listorder desc";
    $cmd=\Yii::$app->db->createCommand($sql);
    $cmd->bindParam(":parentid", $id);
    $cnt = $cmd->queryScalar();
    if (!in_array($id, $rightarr)){
        continue;
    }
    if($cnt<=0) {
        ?>
        <li class="hover <?php if($i==1){ echo "hover-show hover-shown"; } ?>">
            <?php if($i==1)  ?>
            <a href="/admin/<?php echo $rs['action']; ?>/<?php echo $rs['method']; ?>">
            <a href="/admin/<?php echo $rs['action']; ?>/<?php echo $rs['method']; ?>">
                <i class="<?php echo $rs['icon']; ?>"></i>
                <span class="menu-text"> <?php echo $rs['name']; ?> </span>
            </a>

            <b class="arrow"></b>
        </li>
        <?php
        $i++;
    }else {
        ?>
        <li class="hover">
            <a class="dropdown-toggle" href="#">
                <i class="<?php echo $rs['icon']; ?>"></i>
                <span class="menu-text"> <?php echo $rs['name']; ?> </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                <?php
                $sql = "select * from {{%tbl_menu}} where parentid=:parentid order by listorder desc";
                $cmd=\Yii::$app->db->createCommand($sql);
                $cmd->bindParam(":parentid", $id);
                $res_sec = $cmd->queryAll();
                foreach ($res_sec as $r2){
                    $id=$r2['id'];
                    if (!in_array($id, $rightarr)){
                        continue;
                    }
                    ?>
                    <li class="hover">
                        <a href="/admin/<?php echo $r2['action']; ?>/<?php echo $r2['method']; ?>">
                            <i class="<?php echo $r2['icon']; ?>"></i>
                            <?php echo $r2['name']; ?>
                        </a>

                        <b class="arrow"></b>
                    </li>
                <?php } ?>

            </ul>
        </li>
    <?php
    }
endforeach;
?>