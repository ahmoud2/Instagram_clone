<nav class="navigation">
    <div class="navigation__column">
        <a href="#">
            <img src="{{url('storage/app-images/logo.png')}}" />
        </a>
    </div>
    <div class="navigation__column">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Search">
    </div>
    <div class="navigation__column">
        <ul class="navigations__links">
            <li class="navigation__list-item">
                <a href="explore.html" class="navigation__link">
                    <i class="fa fa-compass fa-lg"></i>
                </a>
            </li>
            <li class="navigation__list-item">
                <a href="#" class="navigation__link">
                    <i class="fa fa-heart-o fa-lg"></i>
                </a>
            </li>
            <li class="navigation__list-item">
                <a href="{{ url('/profiles/'.Auth()->user()->username) }}" class="navigation__link">
                    <i class="fa fa-user-o fa-lg"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
