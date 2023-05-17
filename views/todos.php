<div class="content">
    <h2>Todos page</h2>
    <div class="add-task">
        <div class="block-title">
            <p class="block-title">Add a task</p>
        </div>
        <form action="/?action=add" method = "POST" class="block-form">
            <label>Item</label>
            <input name="todo_item" placeholder="What do you want to do?" type="text">
            <p>Enter what you want to procastinate)</p>
            <button class="submit-btn" type="submit">Submit</button>
        </form>
    </div>

    <div class="tasks">
        <div class="block-title">
            <p>Tasks</p>
        </div>
        <table class='table'>
        <?php            
            if(empty($todoes)):
                echo 'Create your first todo!';
            else:
            ?>
            <tr class = 'row-title'>
                <th>Item</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php 
            endif;
            foreach($todoes as $entry):  ?>
                <tr class = 'row'>
                    <td class='<?php echo $entry['todo_status']?>'><?php echo $entry['todo_item'] ?></td>
                    <td><?php echo $entry['todo_status'] == 'complete' ? 'in'.$entry['todo_status']: 'complete'; ?>

                    
                    </td>
                    <td>
                        <form 
                        class = "btn-form" 
                        action="/?action=<?php echo $entry['todo_status']?>&todo_id=<?php echo $entry['todo_id']?>#form" 
                        method = "POST">
                            <button class="<?php echo $entry['todo_status']?>-btn" type="submit">
                                <?php echo ucfirst($entry['todo_status'])?>
                            </button>
                        </form>


                            <form class="btn-form" method="POST">
                                <button class="delete-btn" type="button" onclick="openPopup()">Delete</button>
                            </form>

                            <!-- Popup -->
                            <div id="popup-overlay" class="popup-overlay">
                                <form action="/?action=delete&todo_id=<?php echo $entry['todo_id']?>#form" class="btn-form" method="POST">
                                    <div class="popup-content">
                                        <span class="popup-close" onclick="closePopup()">&times;</span>
                                        <p>You're sure you want to remove this item?</p>
                                        <button class="popup-confirm-btn">Ok</button>
                                    </div>
                                </form>
                            </div>

                    </td>
                </tr>
            <?php 
            endforeach;
            ?>
        
       
        </table> 
    </div>
    <form id='form' action="#form" method="get">
        <?php 
        if (count($pages) > 1 ):
            foreach($pages as $pagenum):  
        ?>
            <button name="page_num" value=<?php echo $pagenum ?> type="submit" class="page_num"><?php echo $pagenum ?></button>
        <?php 
            endforeach; 
        endif
        ?>
    </form>