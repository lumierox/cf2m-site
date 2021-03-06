<?php
    //index Employeur
    include_once '../include/config.php';
    include_once '../modele/fonctions-db.php';
    include_once '../include/fonctions.php';
    session_start();
    $array_dirname = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
    $dossier_parent = array_pop($array_dirname);
    
    $pages = array();
    $pages_db = select('page', '*', 'ORDER BY ordre ASC');
    $i=0;
    while($une_page= mysqli_fetch_assoc($pages_db)){
        $pages[$i]=$une_page;
        $i++;
    }
    
    $content = "affichage contenu par defaut d'employeur";
    
    if(!isset($_GET['menu'])){
        //!!!!!!!!!!!!!!!!!!!!! affichage page id 1 (formation)    
        $content = '<h1 class="title-cata">CATALOGUE DES FORMATIONS</h1>';
        //pour l'affichage contenu html venant de la BD
        //AJOUTER HTML DECODE
        $mysqli_result_texte = select('texte', '*', "WHERE url_group='form' AND ordre=1 ORDER BY page_id ASC");
        
        if(!is_string($mysqli_result_texte)){
            while($un_texte=  mysqli_fetch_assoc($mysqli_result_texte)){
                
                $titre_page = select('page','titre', 'WHERE id='.$un_texte['page_id']);
                $titre_page = mysqli_fetch_assoc($titre_page);
                
                $content.= '<'.$un_texte['element'].' class="'.$un_texte['classe'].'">';
                $content.= (!empty($un_texte['url_image'])) ? "<div class='miniature_image'><a href='?menu=".$un_texte['page_id']."'><img src='".html_entity_decode($un_texte['url_image'])."' alt='".$un_texte['titre']."' title='".$un_texte['titre']."'><span class='hover-miniature-image'></span></a></div>": "";
                $content.= "<h2 style='color:".$un_texte['couleur']."; border-bottom:1px solid ".$un_texte['couleur']."'>".html_entity_decode($titre_page['titre'])."</h2>";
                $content.= truncateHtml(html_entity_decode($un_texte['texte']),150);
                $content.= "<span><a class='liremore' href='?menu=".$un_texte['page_id']."'>Pour plus d’infos... [+]</a> </span>";
                $content.= '</'.$un_texte['element'].'>';
            }
        }else{
            $content = '<p>Aucune formation ...</p>';
        }
        
        include_once 'controleur/index.php';
    }else{
        
        // petite triche pour afficher la même page A propos dans employeur que demandeur d'employe
        if($_GET['menu']==22){
            
            foreach($pages AS $value){
                //si l'id du GET est une ID valide (dans la bd)
                if($_GET['menu']===$value['id']){
                    //TITRE ??????
                    //$content = '<h1 class="title-cata"></h1>';
                    $content = '';

                    $mysqli_result_texte = select('texte', '*', "WHERE page_id=14 ORDER BY ordre ASC");
                    if(!is_string($mysqli_result_texte)){
                        while($un_texte=  mysqli_fetch_assoc($mysqli_result_texte)){

                            $content.= '<'.$un_texte['element'].' class="'.$un_texte['classe'].'">';
                            $content.= "<h2 class='bandrolle'>".html_entity_decode($un_texte['titre'])."</h2>";
                            //$content.= (!empty($un_texte['url_image'])) ? "<div class='miniature_image'><img src='".$un_texte['url_image']."' alt='".$un_texte['titre']."' title='".$un_texte['titre']."'></div>": "";
                            //$content.= "<h2><a href='?menu=".$un_texte['page_id']."'>". html_entity_decode($un_texte['titre'])."</a></h2>";
                            $content.= "<p>".nl2br(html_entity_decode($un_texte['texte']))."</p>";
                            $content.= '</'.$un_texte['element'].'>';
                        }
                    }else{
                        $content ='<p>Aucune donnée ...</p>';
                    }

                    include_once 'controleur/index.php';
                }else{
                    $content = "<p> Page non trouvée</p>";
                }
            }
            
        }else if($_GET['menu']==21){
            
            //!!!!!!!!!!!!!!!!!!!!! affichage page id 1 (formation)    
            $content = '<h1 class="title-cata">CATALOGUE DES FORMATIONS</h1>';
            //pour l'affichage contenu html venant de la BD
            //AJOUTER HTML DECODE
            $mysqli_result_texte = select('texte', '*', "WHERE url_group='form' AND ordre=1 ORDER BY page_id ASC");

            if(!is_string($mysqli_result_texte)){
                while($un_texte=  mysqli_fetch_assoc($mysqli_result_texte)){

                    $titre_page = select('page','titre', 'WHERE id='.$un_texte['page_id']);
                    $titre_page = mysqli_fetch_assoc($titre_page);

                    $content.= '<'.$un_texte['element'].' class="'.$un_texte['classe'].'">';
                    $content.= (!empty($un_texte['url_image'])) ? "<div class='miniature_image'><a href='?menu=".$un_texte['page_id']."'><img src='".html_entity_decode($un_texte['url_image'])."' alt='".$un_texte['titre']."' title='".$un_texte['titre']."'><span class='hover-miniature-image'></span></a></div>": "";
                    $content.= "<h2 style='color:".$un_texte['couleur']."; border-bottom:1px solid ".$un_texte['couleur']."'>".html_entity_decode($titre_page['titre'])."</h2>";
                    $content.= truncateHtml(html_entity_decode($un_texte['texte']),150);
                    $content.= "<span><a class='liremore' href='?menu=".$un_texte['page_id']."'>Pour plus d’infos... [+]</a> </span>";
                    $content.= '</'.$un_texte['element'].'>';
                }
            }else{
                $content = '<p>Aucune formation ...</p>';
            }

            include_once 'controleur/index.php';
            
        }else{
            foreach($pages AS $value){
                //si l'id du GET est une ID valide (dans la bd)
                if($_GET['menu']===$value['id']){
                    //TITRE ??????
                    //$content = '<h1 class="title-cata"></h1>';
                    $content = '';

                    $mysqli_result_texte = select('texte', '*', "WHERE page_id=".$value['id']." ORDER BY ordre ASC");
                    if(!is_string($mysqli_result_texte)){
                        while($un_texte=  mysqli_fetch_assoc($mysqli_result_texte)){

                            $content.= '<'.$un_texte['element'].' class="'.$un_texte['classe'].'">';
                            $content.= "<h2 class='bandrolle'>".html_entity_decode($un_texte['titre'])."</h2>";
                            //$content.= (!empty($un_texte['url_image'])) ? "<div class='miniature_image'><img src='".$un_texte['url_image']."' alt='".$un_texte['titre']."' title='".$un_texte['titre']."'></div>": "";
                            //$content.= "<h2><a href='?menu=".$un_texte['page_id']."'>". html_entity_decode($un_texte['titre'])."</a></h2>";
                            $content.= "<p>".nl2br(html_entity_decode($un_texte['texte']))."</p>";
                            $content.= '</'.$un_texte['element'].'>';
                        }
                    }else{
                        $content ='<p>Aucune donnée ...</p>';
                    }

                    include_once 'controleur/index.php';
                }else{
                    $content = "<p> Page non trouvée</p>";
                }
            }
        }
        
        include_once 'controleur/index.php';
    }
