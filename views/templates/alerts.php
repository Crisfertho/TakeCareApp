<?php 
if (!empty($alerts)):
    foreach($alerts as $key => $messages):
        foreach ($messages as $message):
?>  
        <div class="alert <?php echo $key; ?>">
            <?php echo $message; ?>
        </div>
<?php    
        endforeach;
    endforeach;
endif;
?>