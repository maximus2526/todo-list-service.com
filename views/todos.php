<div class="content">
            <h1>Todos</h1>
            <div class="add-task">
                <div class="block-title">
                    <p block-title>Add a task</p>
                </div>
                <form action="/?action=add" method = "POST" class="block-form">
                    <label>Item</label>
                    <input name="todo_item" placeholder="What do you want to do?" type="text">
                    <p>Enter what you want to procastinate</p>
                    <button class="submit-btn" type="submit">Submit</button>
                </form>
            </div>

            <div class="tasks">
                <div class="block-title">
                    <p>Tasks</p>
                </div>
                <table class='table'>
                    <tr class = 'row'>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                    $todos = getTodosAction();
                    foreach($todos as $entry): 
                        $todo_id = $entry['todo_id']
                    ?>
                        <tr class = 'row'>
                            <td><?php echo $entry['todo_item'] ?></td>
                            <td><?php echo $entry['todo_status'] ?></td>
                            <td>
                                <form class = "btn-form" action="/?action=<?php echo 'Complete'?>" method = "POST">
                                    <button class="complete-btn" type="submit"><?php echo 'Complete'?></button>
                                </form>
                                <form class = "btn-form" action="/?action=delete&todo_id=<?php echo $todo_id?>" method = "POST">
                                    <button class="delete-btn" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>