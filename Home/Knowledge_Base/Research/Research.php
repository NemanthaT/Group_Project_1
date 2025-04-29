<?php

    require_once '../../../config/config.php';

    $sql = "SELECT * FROM researchpapers";
    $result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - About Us</title>
    <link rel="stylesheet" href="Research.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- Main Section -->
    <main>
        <section class="knowledge-base">
            <h1 class="kb-heading">Knowledge Base</h1>
            <div class="research-section">
                <h2 class="research-heading">Research</h2>
                <p class="research-description">
                    Research can cover a vast array of topics across various disciplines.
                    Below, you can explore the types of research we provide through our website:
                </p>
                <div class="research-types">
                    <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="research-item">';
                            echo '<button class="faq-question">';
                            echo $row['title'] . '<i class="fas fa-chevron-down"></i>';
                            echo '</button>';
                            echo '<div class="faq-answer">';
                            echo '<p>' . $row['content'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <script>
        var faqButtons = document.querySelectorAll('.faq-question');

        faqButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.classList.toggle('active');
                let answer = button.nextElementSibling;
                answer.classList.toggle('show');
            });
        });
    </script>
</body>

</html>