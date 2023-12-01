<?php
    session_start();
    include "./logic/common_functions.php";
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $selectedPage = sanitize_input($_GET["sr"]);
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <title>
            <?php
                if($selectedPage=="master_suite"){
                    echo "Master Suite";
                }elseif($selectedPage=="junior_suite"){
                    echo "Junior Suite";
                }elseif($selectedPage=="superior_room"){
                    echo "Superior Room";
                }elseif($selectedPage=="luxury_room"){
                    echo "Luxury Room";
                }elseif($selectedPage=="luxury_e_room"){
                    echo "Luxury Extended Room";
                }
            ?> 
        </title>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="description" content="Hotel Bacher Buchungsplatform">
        <meta name="author" content="Philipp Huber/Matthias Teuschl">
        <meta http-equiv="refresh" content="30">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Import Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
        <!--Link Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <!--Link stylesheet-->
        <link href="./css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <?php
            $currentPage = 'SuitesAndRooms';
            include "./elements/header.php";
            ?>
            <h1>
            <?php
                if($selectedPage=="master_suite"){
                    echo "Master Suite";
                }elseif($selectedPage=="junior_suite"){
                    echo "Junior Suite";
                }elseif($selectedPage=="superior_room"){
                    echo "Superior Room";
                }elseif($selectedPage=="luxury_room"){
                    echo "Luxury Room";
                }elseif($selectedPage=="luxury_e_room"){
                    echo "Luxury Extended Room";
                }
            ?> 
            </h1>
        </header>
        <main>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">    
                    <?php
                        echo '<div class="carousel-item active">';
                        echo '<img ';
                        if($selectedPage=="master_suite"){
                            echo 'src="img/master-suite/ms-suite-1.jpeg" alt="Master Suite Picture 1"';
                        }elseif($selectedPage=="junior_suite"){
                            echo 'src="img/junior-suite/js-suite-1.jpeg" alt="Junior Suite Picture 1"';
                        }elseif($selectedPage=="superior_room"){
                            echo 'src="img/superior-room/sr-1.jpeg" alt="Superior Room Picture 1"';
                        }elseif($selectedPage=="luxury_room"){
                            echo 'src="img/luxury-room/lr-1.jpeg" alt="Luxury Room Picture 1"';
                        }elseif($selectedPage=="luxury_e_room"){
                            echo 'src="img/luxury-extended-room/ler-1.jpeg" alt="Superior Extended Room Picture 1"';
                        }
                        echo 'class="d-block w-100"';
                        echo '>';
                        echo '</div>';

                        echo '<div class="carousel-item">';
                        echo '<img '; 
                        if($selectedPage=="master_suite"){
                            echo 'src="img/master-suite/ms-suite-2.jpeg" alt="Master Suite Picture 2"';
                        }elseif($selectedPage=="junior_suite"){
                            echo 'src="img/junior-suite/js-suite-2.jpeg" alt="Junior Suite Picture 2"';
                        }elseif($selectedPage=="superior_room"){
                            echo 'src="img/superior-room/sr-2.jpeg" alt="Superior Room Picture 2"';
                        }elseif($selectedPage=="luxury_room"){
                            echo 'src="img/luxury-room/lr-2.jpeg" alt="Luxury Room Picture 2"';
                        }elseif($selectedPage=="luxury_e_room"){
                            echo 'src="img/luxury-extended-room/ler-2.jpeg" alt="Superior Extended Room Picture 2"';
                        }
                        echo 'class="d-block w-100"';
                        echo '>';
                        echo '</div>';

                        echo '<div class="carousel-item">';
                        echo '<img '; 
                        if($selectedPage=="master_suite"){
                            echo 'src="img/master-suite/ms-suite-3.jpeg" alt="Master Suite Picture 3"';
                        }elseif($selectedPage=="junior_suite"){
                            echo 'src="img/junior-suite/js-suite-3.jpeg" alt="Junior Suite Picture 3"';
                        }elseif($selectedPage=="superior_room"){
                            echo 'src="img/superior-room/sr-3.jpeg" alt="Superior Room Picture 3"';
                        }elseif($selectedPage=="luxury_room"){
                            echo 'src="img/luxury-room/lr-3.jpeg" alt="Luxury Room Picture 3"';
                        }elseif($selectedPage=="luxury_e_room"){
                            echo 'src="img/luxury-extended-room/ler-3.jpeg" alt="Superior Extended Room Picture 3"';
                        }
                        echo 'class="d-block w-100"';
                        echo '>';
                        echo '</div>';

                        if($selectedPage=="master_suite" || $selectedPage=="junior_suite" || $selectedPage=="luxury_e_room"){
                            echo '<div class="carousel-item">';
                            echo '<img '; 
                            if($selectedPage=="master_suite"){
                                echo 'src="img/master-suite/ms-suite-4.jpeg" alt="Master Suite Picture 4"';
                            }elseif($selectedPage=="junior_suite"){
                                echo 'src="img/junior-suite/js-suite-4.jpeg" alt="Junior Suite Picture 4"';
                            }elseif($selectedPage=="luxury_e_room"){
                                echo 'src="img/luxury-extended-room/ler-4.jpeg" alt="Superior Extended Room Picture 4"';
                            }
                            echo 'class="d-block w-100"';
                            echo '>';
                            echo '</div>';
                        }

                        if($selectedPage=="master_suite" || $selectedPage=="junior_suite"){
                            echo '<div class="carousel-item">';
                            echo '<img '; 
                            if($selectedPage=="master_suite"){
                                echo 'src="img/master-suite/ms-suite-5.jpeg" alt="Master Suite Picture 5"';
                            }elseif($selectedPage=="junior_suite"){
                                echo 'src="img/junior-suite/js-suite-5.jpeg" alt="Junior Suite Picture 5"';
                            }
                            echo 'class="d-block w-100"';
                            echo '>';
                            echo '</div>';
                        }

                        if($selectedPage=="master_suite"){
                            echo '<div class="carousel-item">';
                            echo '<img '; 
                            echo 'src="img/master-suite/ms-suite-6.jpeg" alt="Master Suite Picture 6"';
                            echo 'class="d-block w-100"';
                            echo '>';
                            echo '</div>';
                        }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col mt-5">
                        <?php
                            if($selectedPage=="master_suite"){
                                echo "WOHNEN UND SCHLAFEN IN MODERNEM LUXUS. IN DEN GETRENNTEN WOHN- UND SCHLAFBEREICHEN UNSERER 70 M² GROSSEN MASTER SUITE VERMISCHEN 
                                SICH EXQUISITE ANTIQUITÄTEN MIT TRENDIGEN DESIGNERMÖBELN ZU LUXURIÖSER ELEGANZ";
                            }elseif($selectedPage=="junior_suite"){
                                echo "IN UNSEREN GROSSZÜGIGEN JUNIOR SUITEN REGEN ROY LICHTENSTEINS POP-ART WERKE IM KECKEN SPIEL MIT 
                                MODERNER ELEGANZ DIE SINNE AN. LASSEN SIE DAS FLAIR WIENS BEI EINEM ENTSPANNENDEN BAD IN DER 
                                DESIGNERWANNE AUF SICH WIRKEN ODER STIMMEN SIE SICH IM TRENDIGEN LOUNGEBEREICH DER SUITE AUF 
                                DEN ABENDLICHEN KONZERTBESUCH EIN.";
                            }elseif($selectedPage=="superior_room"){
                                echo "DAS DESIGN UNSERER SUPERIOR ZIMMER SPIELT MIT MODERNEN UND ELEGANTEN STILELEMENTEN, 
                                DIE ZU EINEM STIMMUNGSVOLLEN GANZEN KOMPONIERT SIND.";
                            }elseif($selectedPage=="luxury_room"){
                                echo "MODERNE ELEGANZ ZEICHNET UNSERE GROSSZÜGIGEN LUXURY ZIMMER AUS. DAS HARMONISCHE 
                                ZUSAMMENSPIEL VON ZEITGENÖSSISCHEN DESIGNERMÖBELN UND MODERNER KUNST LÄDT ZUM 
                                VERWEILEN UND GENIESSEN EIN. SANFTES TAGESLICHT UND HELLE FARBEN LASSEN DIE SINNE 
                                ABENDS ZUR RUHE KOMMEN UND SORGEN IN DER FRÜH FÜR EIN ENTSPANNTES ERWACHEN.";
                            }elseif($selectedPage=="luxury_e_room"){
                                echo "ANKOMMEN. ENTSPANNEN. GENIESSEN. MODERN INTERPRETIERTE HIMMELBETTEN VERLEIHEN UNSEREN GROSSZÜGIGEN 
                                LUXURY EXTENDED ZIMMERN EINEN HAUCH LÄSSIGER ROMANTIK. BEI EINEM GLÄSCHEN AUF DEM EIGENEN BALKON MIT 
                                BLICK IN DEN INNENHOF LASSEN SICH DIE RUHIGEN SEITEN DER STADT ENTDECKEN.";
                            }
                        ?>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mt-5 justify-content-start">
                        <?php
                            if($selectedPage=="master_suite"){
                                echo "EINE NACHT AB<br>666 € PRO ZIMMER<br>INKL. FRÜHSTÜCK";
                            }elseif($selectedPage=="junior_suite"){
                                echo "EINE NACHT AB<br>368 € PRO ZIMMER<br>INKL. FRÜHSTÜCK";
                            }elseif($selectedPage=="superior_room"){
                                echo "EINE NACHT AB<br>278 € PRO ZIMMER<br>INKL. FRÜHSTÜCK";
                            }elseif($selectedPage=="luxury_room"){
                                echo "EINE NACHT AB<br>296 € PRO ZIMMER<br>INKL. FRÜHSTÜCK";
                            }elseif($selectedPage=="luxury_e_room"){
                                echo "EINE NACHT AB<br>323 € PRO ZIMMER<br>INKL. FRÜHSTÜCK";
                            }
                        ?>
                    </div>
                    <div class="col-md-6 mt-5 justify-content-start">
                        <?php
                            if($selectedPage=="master_suite"){
                                echo "Das großzügige Badezimmer mit großer, runder Wanne ist ein Rückzugsort für alle Sinne. 
                                Eingerahmt in Marmor mit zwei Waschbecken, extra Dusche und separater Toilette finden 
                                Sie hier Ihre private Wohlfühloase. Bluetooth Lautsprecher von Bang & Olufsen sorgen 
                                für hervorragenden Sound in Bad und Wohnzimmer. Tiefe Fensterbänke lassen Träume Realität
                                werden. Nachts betten Sie sich wie die englische Königsfamilie und genießen auf den 
                                Boxspringbetten von Vispring besten Schlafkomfort.";
                            }elseif($selectedPage=="junior_suite"){
                                echo "Auf 40m² inklusive Badezimmer mit freistehender Wanne, extra Regendusche und separater 
                                Toilette wird Ihr Aufenthalt zu einem echten Erlebnis. Einige Junior Suiten verfügen 
                                zusätzlich über einen begehbaren Kleiderschrank.";
                            }elseif($selectedPage=="superior_room"){
                                echo "Kunstvolle, goldene Wandmalereien und Fotografien von Hubertus Hohenlohe bringen den 
                                Charme Wiens ins Zimmer. Auf durchschnittlich 25 m² sind unsere Superior Zimmer mit 
                                einem einladenden Lesebereich, großem Mirror Screen und Badezimmer mit geräumiger 
                                Dusche ausgestattet. Erholsamer Schlaf mit Blick in den begrünten Innenhof.";
                            }elseif($selectedPage=="luxury_room"){
                                echo "Unsere großzügigen Luxury-Zimmer bieten uneingeschränkten Luxus auf 30 m²: Parkettböden, 
                                Designermöbel und Mirror-Screen im lichtdurchfluteten Interior Design by yoo. 
                                Die Badezimmer sind mit Regendusche ausgestattet und mit edlen Accessoires eingerichtet.";
                            }elseif($selectedPage=="luxury_e_room"){
                                echo "Diese Zimmer erweitern ihre großzügigen 30 m² um einen breiten Balkon, der in den 
                                begrünten und ruhigen Innenhof blickt. Moderne Himmelbetten verleihen den Doppelzimmern 
                                im Interior Design von yoo einen Hauch Romantik.";
                            }
                        ?> 
                    </div>
                </div>
            </div>
        </main>
        <?php include "./elements/footer.php"; ?>
    </body>
</html>