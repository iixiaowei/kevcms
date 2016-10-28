<ul class="nav nav-list">
    <?php
    $sql = "select * from {{%tbl_menu}} where parentid=0 order by listorder desc";
    $cmd=\Yii::$app->db->createCommand($sql);
    $results  = $cmd->queryAll();
    foreach ($results as $rs){
        $id=$rs['id'];
        $sql = "select count(id) as cnt from {{%tbl_menu}} where parentid=:parentid order by listorder desc";
        $cmd=\Yii::$app->db->createCommand($sql);
        $cmd->bindParam(":parentid", $id);
        $cnt = $cmd->queryScalar();
        if (!in_array($id, $rightarr)){
            continue;
        }
        if ($cnt<=0){
            ?>
            <li <?php if( $menu==$rs['focus']){ echo 'class="active"'; } ?>>
                <a href="/admin">
                    <i class="<?php echo $rs['icon']; ?>"></i>
                    <span class="menu-text"> <?php echo $rs['name'] ?> </span>
                </a>
                <b class="arrow"></b>
            </li>
        <?php
        }else{
            ?>
            <li <?php if( $menu==$rs['focus']){ echo 'class="active open"'; } ?>>
                <a href="#" class="dropdown-toggle">
                    <i class="<?php echo $rs['icon']; ?>"></i>
                    <span class="menu-item-parent"><?php echo $rs['name'] ?></span>
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
                    $sql = "select count(id) as cnt from {{%tbl_menu}} where parentid=:parentid order by listorder desc";
                    $cmd=\Yii::$app->db->createCommand($sql);
                    $cmd->bindParam(":parentid", $id);
                    $cnt = $cmd->queryScalar();
                    if (!in_array($id, $rightarr)){
                        continue;
                    }
                    if ($cnt<=0){
                        ?>
                        <li <?php if( $active==$r2['active']){ echo 'class="active"'; } ?>><a href="/admin/<?php echo $r2['action']; ?>/<?php echo $r2['method']; ?>"><i
                                    class="<?php echo $r2['icon']; ?>"></i><?php echo $r2['name']; ?></a></li>
                    <?php
                    }else{
                    ?>
                    <li>
                        <a href="#"><i class="<?php echo $r2['icon']; ?>"></i>
                            <span class="menu-item-parent"><?php echo $r2['name']; ?></span></a>
                        <ul class="submenu">
                            <?php
                            $sql = "select * from {{%tbl_menu}} where parentid=:parentid order by listorder desc";
                            $cmd=\Yii::$app->db->createCommand($sql);
                            $cmd->bindParam(":parentid", $id);
                            $res_three = $cmd->queryAll();
                            foreach ($res_three as $r3){
                                $id = $r3['id'];
                                if (!in_array($id, $rightarr)){
                                    continue;
                                }
                                ?>
                                <li <?php if( $menu==$r3['focus']){ echo 'class="active"'; } ?>>
                                    <a href="/admin/<?php echo $r3['action']; ?>/<?php echo $r3['method']; ?>"><i class="<?php echo $r3['icon']; ?>"></i><?php echo $r3['name']; ?></a>
                                </li>

                            <?php } ?>
                        </ul>
                        <?php
                        }
                        }
                        ?>
                </ul>

            </li>

        <?php
        }
    }
    ?>
</ul>