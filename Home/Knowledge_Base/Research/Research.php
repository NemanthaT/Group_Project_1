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
                <div class="research-item">
                    <button class="faq-question">
                         Development Finance<i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>In-depth analysis and strategies for funding development initiatives.</p>
                    </div>
                </div>
                <div class="research-item">
                    <button class="faq-question">
                        Micro Finance <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Exploration of financial solutions tailored for small-scale entrepreneurs and individuals.</p>
                    </div>
                </div>
                <div class="research-item">
                    <button class="faq-question">
                        Organizational Development <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Research on improving organizational structures, efficiency, and culture.</p>
                    </div>
                </div>
                <div class="research-item">
                    <button class="faq-question">
                       SME Development <i class="fas fa-chevron-down"></i> 
                    </button>
                    <div class="faq-answer">
                        <p>Studies and methodologies for advancing small and medium enterprises.</p>
                    </div>
                </div>
                <div class="research-item">
                    <button class="faq-question">
                        Gender Finance <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Insights into enhancing financial inclusivity for women and underrepresented groups.</p>
                    </div>
                </div>
                <div class="research-item">
                    <button class="faq-question">
                        Institutional Development<i class="fas fa-chevron-down"></i> 
                    </button>
                    <div class="faq-answer">
                        <p>Research on bolstering institutional capabilities and operational efficiency.</p>
                    </div>
                </div>
                <div class="research-item">
                    <button class="faq-question">
                         Community Development<i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Studies and strategies for building stronger, more resilient communities.</p>
                    </div>
                </div>
                <div class="research-item">
                    <button class="faq-question">
                         Strategic and Operational Planning<i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Research-based guidance for developing and implementing organizational strategies.</p>
                    </div>
                </div>
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
