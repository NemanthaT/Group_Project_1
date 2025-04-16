<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - About Us</title>
    <link rel="stylesheet" href="Consultancy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
        <section class="knowledge-base">
            <h1 class="kb-heading">Knowledge Base</h1>
            <div class="consultancy-section">
                <h2 class="consultancy-heading">Consultancy</h2>
                <p class="consultancy-description">
                    Consultancies offer specialized expertise and guidance across various industries and domains.
                    Below, you can explore the types of consultancies we provide through our website:
                </p>
                <div class="consultancy-types">
                    <div class="consultancy-item">
                        <button class="faq-question">
                             Development Finance<i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Guidance on structuring and managing finance for development projects, ensuring sustainability and growth.</p>
                        </div>
                    </div>
                    <div class="consultancy-item">
                        <button class="faq-question">
                            Micro Finance <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Specialized advice on creating financial services for small-scale entrepreneurs and individuals.</p>
                        </div>
                    </div>
                    <div class="consultancy-item">
                        <button class="faq-question">
                            Organizational Development <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Strategies to improve efficiency, structure, and culture within organizations.</p>
                        </div>
                    </div>
                    <div class="consultancy-item">
                        <button class="faq-question">
                           SME Development <i class="fas fa-chevron-down"></i> 
                        </button>
                        <div class="faq-answer">
                            <p>Supporting small and medium enterprises through growth strategies and operational improvements.</p>
                        </div>
                    </div>
                    <div class="consultancy-item">
                        <button class="faq-question">
                            Gender Finance <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Providing solutions to improve financial inclusion and opportunities for women and underrepresented groups.</p>
                        </div>
                    </div>
                    <div class="consultancy-item">
                        <button class="faq-question">
                            Institutional Development<i class="fas fa-chevron-down"></i> 
                        </button>
                        <div class="faq-answer">
                            <p>Enhancing the capabilities and efficiency of institutions through tailored solutions.</p>
                        </div>
                    </div>
                    <div class="consultancy-item">
                        <button class="faq-question">
                             Community Development<i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Programs and strategies focused on building stronger, more sustainable communities.</p>
                        </div>
                    </div>
                    <div class="consultancy-item">
                        <button class="faq-question">
                             Strategic and Operational Planning<i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Expert guidance on creating and implementing strategies to achieve organizational goals.</p>
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
