<?php

namespace app\view;


use app\model\Produits;
use Slim\Slim;

class VueListeEnchere
{
    function render($methode, $encheres=null)
    {
        switch ($methode) {
            case 0 :
                ?>
                <?php include('elements/header.php'); ?>
                <section id="content">
                <div class="container_12">
                    <h2>liste des enchères</h2>
                    <div class="container_3">
                        <h3>Options</h3>
                        <input class="inputSpe" type="text" id="motCle" placeholder="Mots clés:">
                    </div>
                    <div class="container_12" id="produits">
                        <?php
                        foreach ($encheres as $v) {
                            echo $this->divProduit($v);
                        }

                        ?>

                        <div class="clear"></div>
                    </div>
                </div>
                <?php include('elements/footer.php'); ?>

                <script>
                    $('#motCle').on('input', function () {
                        $.ajax({
                            url:'/projetcsi/encheres',
                            type:'post',
                            data: {
                                'motCle': $('#motCle').val()
                            },
                            success:function(data){
                                $('#produits').html(data+'<div class="clear"></div>');
                            },
                            error: function (e) {
                                console.log(e.responseText);
                            }
                        });
                    });
                </script>
                <?php
                break;
        }
    }

    /**
     * @param Produits $produit
     */
    function divProduit($p) {$s = Slim::getInstance();
        $res = '<div class="grid_12">
            <div class="extra_wrapper">
                <img src="'.dirname($_SERVER['SCRIPT_NAME']).'/images/'.$p->lienImg.'" alt="" class="img_inner fleft"/>
                <div class="text1 tx__2"><a href="'.$s->urlFor('produit', array('id' => $p->id)).'">'.$p->libelle.'</a> ('.$p->etat.')</div>
                    <p> '.$p->description.' </p>
                    <p>';

        foreach ($p->mot as $k=>$m) {
            if($k == 0)
                $res .= '#'.$m;
            else
                $res .= ', #'.$m;
        }

        $res .='</p>
                 <a href="'.$s->urlFor('produit', array('id' => $p->id)).'" class="link-1">Enchérir</a>
            </div>
        </div>';
        return $res;
    }
}