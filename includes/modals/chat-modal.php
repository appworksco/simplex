<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="chatModalLabel">CTS Chat Box</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Chat box -->
                <div style="height: 400px; overflow-y: scroll; background-color: #f0f0f0;">
                    <div style="padding: 10px;">
                        <?php
                        // Fetch chat messages
                        $chatMessages = $ctsFacade->fetchChatMessages($ctsId);

                        // Check if there are messages
                        if ($chatMessages->rowCount() > 0) {
                            // Loop through each message
                            while ($message = $chatMessages->fetch(PDO::FETCH_ASSOC)) {
                                // Determine the alignment based on the user who sent the message
                                $alignment = ($message['user_id'] == $userId) ? 'right' : 'left';

                                // Get the user's name from the database
                                if ($alignment == 'left') {
                                    $senderName = $usersFacade->fetchUserNameById($message['user_id']);
                                    $senderLabel = $senderName['first_name'] . ' ' . $senderName['last_name'];
                                }

                        ?>
                                <!-- Message container -->
                                <div style="text-align: <?= $alignment ?>; margin-bottom: 10px;">
                                    <!-- Chat bubble -->
                                    <div style="max-width: 80%; padding: 8px; border-radius: 8px; background-color: <?= ($alignment == 'right') ? '#d4e3fb' : '#ffffff' ?>; display: inline-block;">
                                        <!-- Message content -->
                                        <p style="text-align: left;">
                                            <?php if ($alignment == 'left') : ?>
                                                <?php if ($senderLabel != 'You') : ?>
                                                    <strong><?= $senderLabel ?></strong><br><br>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?= $message['message'] ?>
                                        </p>
                                        <!-- Timestamp -->
                                        <p style="font-size: 12px; color: #999; margin: 0;"><?= date('F j, Y g:i A', strtotime($message['created_at'])) ?></p>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            // If no messages found
                            echo '<p>No messages available.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Chat input area -->
            <form id="chatForm" action="cts" method="POST">
                <div class="modal-footer">
                    <input type="hidden" name="cts_id" value="<?= $ctsId ?>">
                    <input type="hidden" name="user_id" value="<?= $userId ?>">
                    <textarea class="form-control" name="message" id="messageInput" placeholder="Type your message..." rows="1"></textarea>
                    <button type="submit" class="btn btn-primary" name="cts_chat">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>