<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Static Template</title>

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
  </head>
  <body
    style="
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
      font-size: 14px;
    "
  >
    <div
      style="
        max-width: 680px;
        margin: 0 auto;
        padding: 45px 30px 60px;
      
        background-image: url(https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661497957196_595865/email-template-background-banner);
        background-repeat: no-repeat;
        background-size: 800px 452px;
        background-position: top center;
        font-size: 14px;
        color: #434343;
      "
    >


      <main>
        <img src="/storage/image.png" alt="">
        <div
          style="
            margin: 0;
            margin-top: 70px;
            padding: 92px 30px 20px;
            background: #ffffff;
            border-radius: 30px;
            text-align: center;
          "
        >
          <div style="width: 100%; max-width: 489px; margin: 0 auto;">
            <h1
              style="
                margin: 0;
                font-size: 24px;
                font-weight: 500;
                color: #1f1f1f;
              "
            >
            
              <h1>Your OTP</h1>
            </h1>
            <p style="margin: 0; margin-top: 17px; font-size: 16px; font-weight: 500;">
                <span style="display: inline-block; vertical-align: top;">Hi, {{ $name }}</span>
            </p>
            <p
              style="
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
              "
            >
              You recently requested to update your password on TapZ application. Use the following OTP
              to complete the procedure to change your password.
              Do not share this code with others.
            </p>
            <p
              style="
                margin: 0;
                margin-top: 60px;
                font-size: 40px;
                font-weight: 600;
                letter-spacing: 25px;
                color: #ba3d4f;
                border-radius:10px;
                padding:10px;
                border:1px solid black;
              "
            >
              {{ $otp }}
            </p>
          </div>
        </div>

        <p
          style="
            max-width: 400px;
            margin: 0 auto;
            margin-top: 90px;
            text-align: center;
            font-weight: 500;
            color: #8c8c8c;
          "
        >
          Need help? Ask at
          <a
            href="mailto:archisketch@gmail.com"
            style="color: #499fb6; text-decoration: none;"
            >company@gmail.com</a
          >

        </p>
      </main>

      <footer
        style="
          width: 100%;
          max-width: 490px;
          margin: 20px auto 0;
          text-align: center;
          border-top: 1px solid #e6ebf1;
        "
      >
        <p
          style="
            margin: 0;
            margin-top: 40px;
            font-size: 16px;
            font-weight: 600;
            color: #434343;
          "
        >
          {{ $companyName }}
        </p>
        <p style="margin: 0; margin-top: 8px; color: #434343;">
          Address ABC, City, State.
        </p>
        
        <p style="margin: 0; margin-top: 16px; color: #434343;">
          Copyright © 2024 Company. All rights reserved.
        </p>
      </footer>
    </div>
  </body>
</html>
