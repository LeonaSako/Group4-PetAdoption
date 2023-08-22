<?php
function viewMessages($result)
{
    $crudUser = new CRUD_USER();
    $list = "";

    if (!empty($result)) {

        foreach ($result as $message) {

            $msgid = $message['id'];

            $userId = $message['fk_user_id'];

            $selectUser = $crudUser->selectUsers("id = $userId");
            $user = $selectUser[0];
            $fname = $user['firstName'];
            $lname = $user["lastName"];

            $msg = $message['message'];
            $date = $message['date'];

            $readstatus = ($message['readmsg'] == 1) ? 'unread' : 'read';

            $list .= <<<HTML
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Sent by</h5>
                                    <p class="card-text">$fname $lname</p>
                                    <h5 class="card-title">Message</h5>
                                    <p class="card-text">$msg</p>
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="reply">Reply:</label>
                                            <textarea class="form-control" id="reply" name="reply" rows="4" required></textarea>
                                        </div>
                                        <div class="gap-2 d-md-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" name="submit-reply">Reply</button>
                                            <a href="../messages/markread.php?id={$msgid}" class="btn btn-primary">Mark as $readstatus</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        HTML;
        }
    } else {
        $list .= "No records found";
    }
    return $list;
}
