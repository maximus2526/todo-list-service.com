<div class="content">
    <h2>Todos page</h2>
    <div class="add-task">
        <div class="block-title">
            <p>Add a task</p>
        </div>
        <form action="/?action=add" method = "POST" class="block-form">
            <label for="todo_item">Item</label>
            <input id="todo_item" name="todo_item" placeholder="What do you want to do?" type="text">
            <p>Enter what you want to procastinate)</p>
            
            <div class="choice-category">
                <label for="category">Choice category:</label>
                <select id="category" name="choiced-category">
                    <option value="Work">Work</option>
                    <option value="Hobby">Hobby</option>
                    <option value="Study">Study</option>
                </select>
            </div>
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
                <th><a href="/?action=sort&by=todo_item$order=DESC">Item</a></th>
                <th><a href="/?action=sort&by=todo_category$order=ASC">Category</a></th>
                <th><a href="/?action=sort&by=todo_status$order=ASC">Status</a></th>
                <th>Action</th>
            </tr>
            <?php 
            endif;
            foreach($todoes as $entry):  ?>
                <tr class = 'row'>
                    <td class='<?php echo $entry['todo_status']?>'><?php echo $entry['todo_item'] ?></td>
                    <td><?php echo $entry['todo_category']?></td>
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
                                <button class="delete-btn" type="button" onclick="openPopup(<?php echo $entry['todo_id']; ?>)">Delete</button>
                            </form>

                            <!-- Popup -->
                            <div id="popup-overlay-<?php echo $entry['todo_id']; ?>" class="popup-overlay">
                            <form id="form-<?php echo $entry['todo_id']; ?>" action="/?action=delete&todo_id=<?php echo $entry['todo_id']?>#form" class="btn-form" method="POST">
                                <div class="popup-content" id="popup-content-<?php echo $entry['todo_id']; ?>">
                                        <span class="popup-close" onclick="closePopup(<?php echo $entry['todo_id']; ?>)">&times;</span>
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