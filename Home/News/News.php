<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - News</title>
    <link rel="stylesheet" href="News.css">
    <script src="news.js"></script>
</head>
<body>
    <main>
        
        <section class="news">
            <div id="main">
                <div>
                    <h1 id="nHeading">News</h1>
                </div>
                <div id="preloader">
                    <div class="spinner"></div>
                </div>

                <div id="overlay" class="overlay"></div>
                <div id="view">
                    <div id="newsView">
                        <button id="closeView" onclick="closeView()">x</button>
                        <div id="newsContent">
                            <center><img id="newsImage" src="" class="news-image">
                            <h2 id="newsTitle"></h2></center>
                            <p id="newsDescription"></p>
                            
                            <div id="date"><p id="newsDate"></p></div>
                        </div>

                    </div>
                </div>
                <div id="allNews">
                    <div id="news">
                        
                    </div>

                    <div id="pagination">
                        <button id="prevBtn" class="pagination-button" onclick="prevPage()">Previous</button>
                        <span id="pageInfo">Page 1 of 1</span>
                        <button id="nextBtn" class="pagination-button" onclick="nextPage()">Next</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>