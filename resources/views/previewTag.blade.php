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
    <!-- <script src="{{ asset('js/script.js') }}" defer></script> -->
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

<?php

        $data=[
            'luggageContact' => '/images/luggageContact.png',
            'luggageBrand' => '/images/luggageBrand.png',
            'luggageType' => '/images/luggageType.png',
            'luggageFontColor' => 'rgba(73, 255, 211, 1)',
            'luggageRewardImage' => '/images/luggageRewardImage.png',

            'kidContact' => '/images/kidContact.png',
            'kidHeight' => '/images/kidheight.png',
            'kidDress' => '/images/dressColor.png',
            'kidFontColor' => 'rgba(255, 196, 0, 1)',
            'kidRewardImage' => '/images/kidReward.png',

            'petContact' => '/images/petContact.png',
            'petFontColor' => 'rgba(252, 26, 64, 1)',
            'petRewardImage' => '/images/petRewardImage.png',
        ];

?>


<body>
    <div class="logo">
        <img src="/images/Tapz.png" alt="">
    </div>

    <div class="slider-container">
        
        <div class="slider">
        @foreach($images as $image)


    
    <div class="slide"><img src="/{{ $image->path }}" alt="Image"></div>
  @endforeach
          <!-- <div class="slide"><img src="/images/image.png" alt="Slide 1"></div>
          <div class="slide"><img src="/images/image.png" alt="Slide 1"></div>
          <div class="slide"><img src="/images/image.png" alt="Slide 1"></div> -->
        </div>
        
      
  <div class="controls">
    <div class="control-btn" onclick="prevSlide()">&#10094;</div>
    <div class="control-btn" onclick="nextSlide()">&#10095;</div>
  </div>
  <div class="slider-indicator"></div>
</div>


    <div style="padding:6px;margin-left:8px;margin-top:10px;">
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
                @if($tag->category === 'luggage')
                 <img src="{{asset($data['luggageContact'])}}" alt="">
                 @elseif($tag->category === 'kid')
                 <img src="{{asset($data['kidContact'])}}" alt="">
                 @else
                 <img src="{{asset($data['petContact'])}}" alt=""> 
                @endif 
            
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
            <img src="{{asset($data['luggageBrand'])}}" alt="">
            @endif

            <p style="margin:0;font-size:14px;font-weight:700;">
            @if($tag->category === 'kid' || $tag->category === 'pet')
                Gender
            @else
            Brand
            @endif 
            </p>
            <p style="margin:0;font-size:16px;font-weight:600;color:gray;white-space: nowrap;">
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
            <img src="{{asset($data['luggageType'])}}" alt="">
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
                {{ $tag->age }} Years
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
            @if($tag->category === 'luggage')
             <img src="{{asset($data['luggageRewardImage'])}}" alt="" style="margin-right: 5px; height: 60px; width: 60px;"> 
            @elseif($tag->category === 'kid')
             <img src="{{asset($data['kidRewardImage'])}}" alt="" style="margin-right: 5px; height: 60px; width: 60px;"> 
            @else
             <img src="{{asset($data['petRewardImage'])}}" alt="" style="margin-right: 5px; height: 60px; width: 60px;">
            @endif 
            <div style="margin-top: 15px;">
                @if($tag->category === 'luggage')
                <p  style="margin:0;font-size:18px;font-weight:700;color:{{$data['luggageFontColor']}};">Reward</p>
                <p style="font-size: 14px; line-height: 1;word-wrap:break-word;">A reward of <span style="color:{{$data['luggageFontColor']}};font-weight:600;">${{ $tag->reward }}</span> will be given to<br> whoever finds the kid</p>
                @elseif($tag->category === 'kid')
                <p  style="margin:0;font-size:18px;font-weight:700;color:{{$data['kidFontColor']}};">Reward</p>
                <p style="font-size: 14px; line-height: 1;word-wrap:break-word;">A reward of <span style="color:{{$data['kidFontColor']}};font-weight:600;">${{ $tag->reward }}</span> will be given to<br> whoever finds the kid</p>
                @else
                <p  style="margin:0;font-size:18px;font-weight:700;color:{{$data['petFontColor']}};">Reward</p>
                <p style="font-size: 14px; line-height: 1;word-wrap:break-word;">A reward of <span style="color:{{$data['petFontColor']}};font-weight:600;">${{ $tag->reward }}</span> will be given to<br> whoever finds the kid</p>
                @endif
            </div>
        </div>
        <div>
            @if($tag->category === 'luggage')
            <p style="margin:0;margin-left:10px;font-size:30px;font-weight:700;color:{{$data['luggageFontColor']}};">${{ $tag->reward }}</p>
            @elseif($tag->category === 'kid')
            <p style="margin:0;margin-left:10px;font-size:30px;font-weight:700;color:{{$data['kidFontColor']}};">${{ $tag->reward }}</p>
            @else
            <p style="margin:0;margin-left:10px;font-size:30px;font-weight:700;color:red;">${{ $tag->reward }}</p>
            @endif
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

        @if($tag->category === 'pet')
        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:6px;font-size:18px;font-weight:600;">Vet Details</p>
            <p style="font-size:15px; text-align:justify;color:gray;">{{$tag->vetDetail}}</p>
        </div>
        @elseif($tag->category === 'kid')
        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:6px;font-size:18px;font-weight:600;">Doctor Detail</p>
            <p style="font-size:15px; text-align:justify;color:gray;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Explicabo dolore, laboriosam debitis in temporibus corporis, 
                ipsum similique molestiae beatae soluta fugiat repellat quibusdam 
                odio velit deserunt fugit vitae aliquid adipisci.</p>
        </div>

        @endif

        @if($tag->category === 'pet' || $tag->category === 'kid')

        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:6px;font-size:18px;font-weight:600;">Medical Issue</p>
            <p style="font-size:15px; text-align:justify;color:gray;">{{$tag->medicalIssue}}</p>
        </div>

        @endif

        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:6px;font-size:18px;font-weight:600;">Note</p>
            <p style="font-size:15px; text-align:justify;color:gray;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Explicabo dolore, laboriosam debitis in temporibus corporis.</p>
        </div>
    </div>
    <script>
  let slideIndex = 0;
  let slideInterval;

  function showSlides() {
    const slider = document.querySelector('.slider');
    const slideWidth = slider.clientWidth;
    const numSlides = slider.children.length;
    
    // Ensure slideIndex stays within valid range
    slideIndex = (slideIndex + numSlides) % numSlides;
    
    slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;

    // Update slider indicator
    const indicatorDots = document.querySelectorAll('.indicator-dot');
    indicatorDots.forEach(dot => dot.classList.remove('active'));
    indicatorDots[slideIndex].classList.add('active');
  }

  function nextSlide() {
    slideIndex++;
    showSlides();
  }

  function prevSlide() {
    slideIndex--;
    showSlides();
  }

  // Create slider indicator dots
  const slider = document.querySelector('.slider');
  const numSlides = slider.children.length;
  const indicatorContainer = document.querySelector('.slider-indicator');
  for (let i = 0; i < numSlides; i++) {
    const dot = document.createElement('div');
    dot.classList.add('indicator-dot');
    if (i === 0) {
      dot.classList.add('active');
    }
    dot.addEventListener('click', () => {
      slideIndex = i;
      showSlides();
    });
    indicatorContainer.appendChild(dot);
  }

  
//   function startAutoScroll() {
//     slideInterval = setInterval(nextSlide, 3000);
//   }

  // Function to stop auto-scrolling
  function stopAutoScroll() {
    clearInterval(slideInterval);
  }

  // Start auto-scrolling when the page loads
  startAutoScroll();
</script>

    
</body>

</html>