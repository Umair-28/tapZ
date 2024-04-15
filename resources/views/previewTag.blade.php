<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
    <title>Document</title>
    <style>
        .controls-container {
            position: absolute;
            bottom: 0;
            left: 10%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="/images/tapz.png" alt="">
    </div>

    <div class="slider-container">
        <div class="slider">
            <div class="slide"><img src="/images/image.png" alt="Slide 1"></div>
            <div class="slide"><img src="/images/image.png" alt="Slide 2"></div>
            <div class="slide"><img src="/images/image.png" alt="Slide 3"></div>
            <!-- Add more slides as needed -->
        </div>
        <div class="slider-controls">
            <div class="slider-indicators"></div>
            <button class="prev-slide">PREVIOUS</button>
            <button class="next-slide">NEXT</button>
        </div>
    </div>
    

    {{-- <div id="demo" class="carousel slide">

        <!-- The slideshow/carousel -->
        <div class="carousel-inner p-3">
   
            
            <div class="carousel-item active">
                <img src="/images/image.png" alt="Los Angeles" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item active">
                <img src="/images/image.png" alt="Los Angeles" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item active">
                <img src="/images/image.png" alt="Los Angeles" class="d-block" style="width:100%">
            </div>
            
 
        </div>
        
     
        <div class="controls-container">
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="carousel-indicators" style="bottom: 0; left: 0; margin-bottom: 10px; margin-left: 10px;">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>
    
    </div> --}}

    <div style="padding:6px;margin-left:18px">
        <div>
            <h1 style="display: inline-block;">
            @if($tag->category === 'kid' || $tag->category === 'pet')
            {{ $tag->name }}
            @else
            Luggage
            @endif
            </h1>
            <p style="display: inline-block; margin-right: 10px;font-size:16px;font-weight:600;color:gray;">(
                @if($tag->category === 'kid' || $tag->category === 'pet')
                {{ $tag->gender }}
                @else
                {{$tag->luggageType}}
                @endif
            )</p> 
        </div>
        <div>
            <img src="/images/location.png" alt="">
            <p style="display: inline-block;margin-left:6px;font-size:13px;font-weight:400;color:gray;">{{ $tag->address }}</p>
        </div>
        <div>
            <img src="/images/contact.png" alt="">
            <p style="display: inline-block;margin-left:6px;font-size:13px;font-weight:400;color:gray;">
            @if($tag->category === 'pet' || $tag->category === 'luggage')
            {{$tag->ownerName}}
            @else
            {{$tag->fatherName}}
            @endif
            </p>
        </div>
    </div>

    <div class="info-tags">

        <div class="tag">
            @if($tag->category === 'pet' || $tag->category === 'kid')
            <img src="/images/heart.png" alt="">
            @else
            <img src="/images/heart.png" alt="">
            @endif

            <p style="margin:0;font-size:14px;font-weight:700;">
            @if($tag->category === 'kid' || $tag->category === 'pet')
                Gender
            @else
            Brand
            @endif 
            </p>
            <p style="margin:0;font-size:16px;font-weight:600;color:gray;">
                @if($tag->category === 'kid' || $tag->category === 'pet')
                {{ $tag->gender }}
            @else
            {{ $tag->brand }}
            @endif 
            </p>
        </div>

        <div class="tag">
            @if($tag->category === 'kid' || $tag->category === 'pet')
            <img src="/images/age.png" alt="">
            @else
            <img src="/images/age.png" alt="">
            @endif
            <p style="margin:0;font-size:14px;font-weight:700;">
                @if($tag->category === 'kid' || $tag->category === 'pet') 
                Age
                @else
                Type
                @endif
            </p>
            <p style="margin:0;font-size:16px;font-weight:600;color:gray; white-space: nowrap;">
                @if($tag->category === 'kid' || $tag->category === 'pet') 
                {{ $tag->age }}
                @elseif($tag->category === 'luggage')
                {{ $tag->luggageType }}
                @endif
            </p>
        </div>

        @if($tag->category === 'kid' || $tag->category === 'pet')
         <div class="tag">
            @if($tag->category === 'pet')
             <img src="/images/weight.png" alt="">
            @elseif($tag->category === 'kid')
             <img src="/images/height.png" alt="">
            @endif
            <p  style="margin:0;font-size:14px;font-weight:700;"  >
            
            
                @if($tag->category === 'kid') 
                 Height 
                 @elseif($tag->category === 'pet')
                 Weight
                @endif
            </p>
            <p  style="margin:0;font-size:16px;font-weight:600;color:gray; white-space: nowrap;">
                @if($tag->category === 'kid') 
                 {{ $tag->height}} Feet
                 @elseif($tag->category === 'pet')
                 {{ $tag->weight}} KG
                @endif
            </p>
         </div>
        @endif

        <div class="tag">
            @if($tag->category === 'pet' || $tag->category === 'luggage')
            <img src="/images/color.png" alt="">
            @elseif($tag->category === 'kid')
            <img src="/images/dressColor.png" alt="">
            @endif

            @if($tag->category === 'pet' || $tag->category === 'luggage')
            <p  style="margin:0;font-size:14px;font-weight:700;white-space: nowrap;">Color</p>
            @elseif($tag->category  === 'kid')
            <p style="margin:0;font-size:14px;font-weight:700;white-space: nowrap;">Dress Color</p>
            @endif

            @if($tag->category === 'pet' || $tag->category === 'luggage')
            <p  style="margin:0;font-size:16px;font-weight:600;color:gray; white-space: nowrap;">{{ $tag->color }}</p>
            @elseif($tag->category === 'kid')
            <p  style="margin:0;font-size:16px;font-weight:600;color:gray; white-space: nowrap;">{{ $tag->dressColor }}</p>
            @endif
        </div>


    </div>

 

    <div class="reward-tag" style="">
        <div style="display: flex; align-items: center;">
            <img src="/images/reward.png" alt="" style="margin-right: 10px; height: 60px; width: 60px;"> 
            <div style="margin-top: 15px;">
                <p  style="margin:0;font-size:18px;font-weight:700;color:red;">Reward</p>
                <p style="font-size: 14px; line-height: 1;white-space:nowrap;">A reward of <span style="color:red;font-weight:600;">${{ $tag->reward }}</span> will be given to<br> whoever finds the kid</p>
            </div>
        </div>
        <div>
            <p style="margin:0;margin-left:10px;font-size:30px;font-weight:700;color:red;">${{ $tag->reward }}</p>
        </div>
    </div>

    <div class="additional-info">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
            <div>
                <p style=" margin:0;font-size:14px;font-weight:600;">Mobile Number</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray;">+01 3847 *******</p>
            </div>
            <div>
                <p style=" margin:0;font-size:14px;font-weight:600;">Secondary Number</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray">+01 1234 *******</p>
            </div>
            <div>
                <p style=" margin:0;font-size:14px;font-weight:600;">Contact Email</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray">{{ $tag->contactEmail }}</p>
            </div>
            <div>
                <p style=" margin:0;font-size:14px;font-weight:600;">Address</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray">Jhon St, 28 Fc 2000, USA, Pakistan, Florida</p>
            </div>
        </div>
        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:6px;font-size:18px;font-weight:600;">Children's Detail</p>
            <p style="font-size:15px; text-align:justify;color:gray;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Explicabo dolore, laboriosam debitis in temporibus corporis, 
                ipsum similique molestiae beatae soluta fugiat repellat quibusdam 
                odio velit deserunt fugit vitae aliquid adipisci.</p>
        </div>
        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:6px;font-size:18px;font-weight:600;">Medical Issue</p>
            <p style="font-size:15px; text-align:justify;color:gray;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Explicabo dolore, laboriosam debitis in temporibus corporis, 
                ipsum similique molestiae beatae soluta fugiat repellat quibusdam 
                odio velit deserunt fugit vitae aliquid adipisci.</p>
        </div>
        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:6px;font-size:18px;font-weight:600;">Note</p>
            <p style="font-size:15px; text-align:justify;color:gray;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Explicabo dolore, laboriosam debitis in temporibus corporis.</p>
        </div>
    </div>


   
    
    
</body>

</html>