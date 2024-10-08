<?php 

                                    $con = mysqli_connect("localhost","root","","dodesk");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $filtervalues = str_replace(" ","%",$filtervalues);                          
                                        $query = "SELECT violationtbl.*, studenttbl.`firstName`, studenttbl.`middleName`, studenttbl.`lastName`
                                        FROM violationtbl 
                                            LEFT JOIN studenttbl ON violationtbl.`studentNumber` = studenttbl.`studentNumber`
                                            WHERE CONCAT(studenttbl.`firstName`, studenttbl.`middleName`, studenttbl.`lastName`) LIKE '%$filtervalues%';";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['violationID']; ?></td>
                                                    <td><?= $items['violationType']; ?></td>
                                                    <td><?= $items['violationCase']; ?></td>
                                                    <td><?= $items['studentNumber']; ?></td>
                                                    <td><?= $items['recordedBy']; ?></td>
                                                    <td><?= $items['studentNumber']; ?></td>
                                                    <td><?= $items['firstName']; ?></td>
                                                    <td><?= $items['middleName']; ?></td>
                                                    <td><?= $items['lastName']; ?></td>
                                                    

                                                   
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="9">No Record Found</td>
                                                    <td><?= $filtervalues; ?></td>

                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>