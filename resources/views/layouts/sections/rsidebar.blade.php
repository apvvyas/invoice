<!--Offcanvas Sidebar -->
<div class="off-sidebar from-right">
    <div class="off-sidebar-container">
        <header class="off-sidebar-header">
            <h2>Todos</h2>
            <a href="#off-canvas" class="off-sidebar-close"></a>
        </header>
        <div class="off-sidebar-content offcanvas-scroll auto-scroll">
            <ul class="button-nav nav nav-tabs mt-3 mb-3 ml-3" role="tablist" id="weather-tab">
                <li><a class="active todo-filter" role="tab" id="today" title="Today">Today</a></li>
                <li><a role="tab" class="todo-filter" id="yesterday" title="Yesterday">Yesterday</a>
                <li><a role="tab" data-toggle="collapse" class="search-filter" href="#collapseOne" aria-expanded="false">Custom Date</a></li>
            </ul>
            <div class="select-date collapse" id="collapseOne">
                <input type="text" class="form-control datepicker" id="search-filter" placeholder="Select value">
            </div>
            <div class="tab-content">
                <!-- Begin Messenger -->
                <div role="tabpanel" class="tab-pane show active fade" id="messenger" data-url="{{route('todos.list')}}" aria-labelledby="messenger-tab">
                    <!-- Begin Chat Message -->
                    <span class="date todo-title">Today</span>

                    <div class="entries"></div>
                    
                    <!-- End Chat Message -->
                    <!-- Begin Message Form -->
                    <div class="enter-message">
                        <div class="send-date collapse" id="send-date">
                            <input type="text" class="form-control d-none" id="todo-date-text">
                            <p class="todo-send-date-display">Selected Date: <strong id="selected-todo-date"></strong></p>
                        </div>
                        <div class="enter-message-form">
                            <input type="text" placeholder="Enter your message..."/>
                        </div>
                        <div class="enter-message-button" style="position: relative;">
                            <a href="#" class="todo-date" style="padding: 0 15px;border-radius: 20px;"><i class="ion-calendar" style="font-size: 2rem;"></i></a>
                        </div>
                        <div class="enter-message-button">
                            <a href="#" class="send-data"><i class="ion-paper-airplane"></i></a>
                        </div>
                    </div>
                    <!-- End Message Form -->
                </div>
                <!-- End Messenger -->
            </div>
        </div>
        <!-- End Offcanvas Container -->
    </div>
    <!-- End Offsidebar Container -->
</div>
<!-- End Offcanvas Sidebar-->