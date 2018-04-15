<?php

namespace app\view;

class View
{

  function render($methode) {
    switch ($methode) {
      case 0 :
      ?>
      <?php include('elements/header.php');?>
    
        <section class="slider_wrapper">
          <div id="camera_wrap" class="">
            <div data-src="images/slide.jpg"></div>
            <div data-src="images/slide1.jpg"></div>
            <div data-src="images/slide2.jpg"></div>
          </div>
        </section>
        <!--=====================
        Content
        ======================-->
        <section id="content"><div class="ic">More Website Templates @ TemplateMonster.com - September22, 2014!</div>
          <div class="container_12">
            <div class="grid_4">
              <div class="banner">
                <a href="#" class="banner_title">Live <br>
                  Events</a>
                  <div class="maxheight"><img src="images/icon1.png" alt=""></div>
                </div>
              </div>
              <div class="grid_4">
                <div class="banner">
                  <a href="#" class="banner_title">Biblical <br>
                    Counseling</a>
                    <div class="maxheight"><img src="images/icon2.png" alt=""></div>
                  </div>
                </div>
                <div class="grid_4">
                  <div class="banner">
                    <a href="#" class="banner_title">Helping <br>
                      Children</a>
                      <div class="maxheight"><img src="images/icon3.png" alt=""></div>
                    </div>
                  </div>
                  <div class="clear"></div>
                </div>
                <article class="block-1">
                  <div class="container_12">
                    <div class="grid_12">
                      <h2>Des clients satisfaits</h2>
                    </div>
                    <div class="grid_4">
                      <img src="images/page1_img1.jpg" alt="">
                      <div class="extra_wrapper">
                        <div class="block-1_title"><a href="#">Héléna Septi</a></div>
                        « Des offres toujours variées et étonnantes ! »
                      </div>
                    </div>
                    <div class="grid_4">
                      <img src="images/page1_img2.jpg" alt="">
                      <div class="extra_wrapper">
                        <div class="block-1_title"><a href="#">Patricia Doyle</a></div>
                        « Depuis que je connais Encheres fun, fini les longues heures d'enchères ! »
                        </div>

                    </div>
                    <div class="grid_4">
                      <img src="images/page1_img3.jpg" alt="">
                      <div class="extra_wrapper">
                        <div class="block-1_title"><a href="#">Ibrahim Rek</a></div>
                        « Des opportunités uniques à saisir. Je ne peux plus m'en passer. »
                      </div>
                    </div>
                    <div class="clear"></div>
                  </div>
                </article>
                <div class="clear sep-1"></div>

              </section>
              <?php include('elements/footer.php');?>

              <?php
              break;
            }
          }
        }
