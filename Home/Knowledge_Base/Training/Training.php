<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - About Us</title>
    <link rel="stylesheet" href="Training.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <main>
        <section class="knowledge-base">
            <h1 class="kb-heading">Knowledge Base</h1>
            <div class="training-section">
                <h2 class="training-heading">Training</h2>
                <p class="training-description">
                    At EDSA Lanka, we are dedicated to empowering individuals and organizations through comprehensive and impactful training programs.
                    Below, you can explore the types of training we provide through our website:
                </p>
                <div class="training-types">
                    <?php
                    require_once('../../../config/config.php');
                    $titles = [
                        'development finance',
                        'micro finance',
                        'organizational development',
                        'sme development',
                        'gender finance',
                        'institutional development',
                        'community development',
                        'strategic and operational planning'
                    ];

                    foreach ($titles as $titleKey) {
                        $titleDisplay = ucwords(str_replace('_', ' ', $titleKey));
                        $sql = "SELECT content FROM knowledgebase WHERE section = 'training' AND title = '" . mysqli_real_escape_string($conn, $titleKey) . "' ORDER BY created_at DESC LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo '<div class="training-item">';
                        echo '<button class="faq-question">' . $titleDisplay . ' <i class="fas fa-chevron-down"></i></button>';
                        echo '<div class="faq-answer">';
                        if ($row && !empty($row['content'])) {
                            echo '<p>' . htmlspecialchars($row['content']) . '</p>';
                        } else {
                            echo '<p style="color:#888;">No content available.</p>';
                        }
                        echo '</div></div>';
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