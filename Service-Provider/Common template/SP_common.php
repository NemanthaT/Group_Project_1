    <div class="container">
        Sidebar 
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li><a href="../SP_Dashboard/SPDash.php"><button><img src="../images/dashboard.png">Dashboard</button></a></li>
                <li><a href="../SP_Appointment/App.php"><button><img src="../images/appointment.png">Appointment</button></a></li>
                <li><a href="../SP_Message/Message.php"><button><img src="../images/message.png">Message</button></a></li>
                <li><a href="../SP_Projects/Project.php"><button><img src="../images/project.png">Project</button></a></li>
                <li><a href="../SP_Bill/Bill.php"><button><img src="../images/bill.png">Bill</button></a></li>
                <li><a href="../SP_Forum/Forum.php"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>       
      
        <header>
            <nav class="navbar">
            
            <div class="calendar-icon">
                <a href="#" id="calendarToggle"><img src="../images/calendar.png" alt="Calendar"></a>
               
                <div id="calendarDropdown" class="calendar-dropdown">
                    <h3>Calendar</h3>
                        <div class="calendar-header">
                            <button id="prevMonth">&lt;</button>
                            <span id="currentMonth">March 2025</span>
                            <button id="nextMonth">&gt;</button>
                        </div>
                        <div class="calendar-grid">
                            <div class="weekdays">
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                                <div>Sun</div>
                            </div>
                        <div id="daysGrid" class="days"></div>
                        </div>
                </div>
            </div>
           
            <div class="notification">
                <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
            </div>
        
            <div class="profile">
                <a href="../SP_Profile/Profile.php"><img src="../images/user.png" alt="Profile"></a>
            </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>                
            </nav>
        </header>
<!-- </div> of container is present in the all the other files(the last </div>) dont remove it{ALTER TABLE forums ADD COLUMN category VARCHAR(100) NOT NULL;} -->