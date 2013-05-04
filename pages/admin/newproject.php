<?php
$res = $dbc->query("SELECT * FROM projects JOIN files ON projects.photo = files.id WHERE projects.cuid='{$_SESSION['cuid']}' AND projects.id='{$pg_id}'");
if($res->num_rows) {
    $r = $res->fetch_assoc();
    include_once($_SERVER['DOCUMENT_ROOT'].'/exec/admin/imagex.php');
    $r['content'] = imagegrow($r['content']);
    $mems = explode(",",$r['members']);
    $title = "Edit Project # ".$pg_id;
}
else
    $title = "New Project";
?>

<form action="/admin/newprojectx" id="editpage" method="POST" enctype="multipart/form-data">
    <h1><?php echo $title; ?></h1>
    <hr/>
    <table>
        <tr>
            <td><h3>Project Title:</h3></td>
            <td><input type="text" class="med_len" name="title" id="title" value="<?php echo $r['title']; ?>"></td>
        </tr>
        <tr>
            <td><h3>Default Image:</h3></td>
            <td>
                <?php if($pg_id): ?>
                <input type="hidden" name="pg_id" value="<?php echo $pg_id; ?>">
                <img src="http://whycooper.org/users/<?php echo $_SESSION['cuid']; ?>/uploads/t/<?php echo $r['name']; ?>" width="300px"><br/>         
                <?php endif; ?>
                <input type="file" name="file">
            </td>
        </tr>
        <tr>
            <td>
                <h3>Other team member(s):</h3>
            </td>
            <td>
                <table id="team_members">
                    <tr>
                        <td>
                            <input type="hidden" name="cuid_0" id="cuid_0" value="<?php echo $mems[0]; ?>">
                        </td>
                        <td>
                            <input type="text" id="member_0" class="query" value="<?php echo $mems[0] ? (new student($mems[0]))->name(): ""; ?>">
                        </td>
                        <td>
                            <img class="addrow" src="/img/plus.png">
                        </td>
                    </tr>
                    <?php
                    if(sizeof($mems) > 1) {
                        for($i=1;$i<sizeof($mems);$i++) {
                            $html .= sprintf('<tr><td><input type="hidden" name="cuid_%d" id="cuid_%d" value="%s"></td>',$i,$i,$mems[$i]);
                            $html .= sprintf('<td><input type="text" id="member_%d" class="query" value="%s"></td>',$i,(new student($mems[$i]))->name());
                            $html .= sprintf('<td><img class="delrow" src="/img/minus.png"></td></tr>');
                        }
                        echo $html;
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <div class="editorlocation">
    	<h3>Project Page Content (include 50+ words and other pics if applicable):</h3>
        <p>To upload a photo, or any other file, click on the "Insert" tab below.</p>
        <textarea id="page" name="page"><?php echo $r['content']; ?></textarea>
    </div>
    <input type="submit" value="Submit" class="prettybutton">
</form>