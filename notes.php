<?php 
    $connection = require_once './Connection.php';
  
    $notes = $connection->getNotes();


    $currentNote = [
        'id' => '',
        'title' =>'',
        'link' => '',
        'description' => '',
        'checkbox' => ''
        
        
    ];

    if (isset($_GET['id'])){
        $currentNote = $connection->getNoteById($_GET['id']);

    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,  shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Add Notes</title> 
        <link rel="stylesheet" href="color.css" type="text/css">
        <link rel="icon" href="icon/favicon.ico">
    </head>

    <body>
        <header>
            <h2>Add Notes</h2>
        </header>
        <div>
            <form action="save.php" class="new-note" method="post">
                <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>">
                <input type="text" name="title" placeholder="NOTE TITLE" autocomplete="off" value="<?php echo $currentNote['title']?>">
                <input type="date" name="date" placeholder="DATE" value="<?php echo $currentNote['date']?>">
                <input type="url" name="link" placeholder="Add link" value="<?php echo $currentNote['link']?>">
                <textarea name="description" id="" cols="30" rows="5" placeholder="Describe Note"><?php echo $currentNote['description']?> </textarea>
                <center> <label class="checkl" for="checkbox">Are you done!! 
                    <input type="checkbox" name="checkbox" value="<?php echo $currentNote['checkbox'] ?>">
                    <span class="checkmark"></span>
                </label></center>
            
                <button>
                    <?php if ($currentNote['id']): ?> 
                        Update note
                    <?php else: ?>    
                        New Note
                    <?php endif; ?>    
                </button>
            </form>

            <div class="notes">
                <?php foreach ($notes as $note): ?>
                    <div class="note">
                        <div class="title">
                            <a href="?id=<?php echo $note['id']?>"><?php echo $note['title'] ?></a>
                        </div>
                        <div class="link">
                            <?php if($note['link'] != null): ?>
                                <a href="<?php echo $note['link']?>" > link </a>
                            <?php endif; ?>    
                        </div>
                        <div class="description">
                            <?php echo $note['description'] ?>
                        </div>
                        <small><?php echo $note['date'] ?></small>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $note['id'] ?>">
                            <button class="close">X</button>
                        </form>
                    </div>
                <?php endforeach; ?>    
            </div>

        </div>
    </body>
</html>
