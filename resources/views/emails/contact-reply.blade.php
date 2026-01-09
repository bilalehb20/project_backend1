<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antwoord op uw contactbericht</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
        <h1 style="color: #0056FF; margin-top: 0;">PhoneShop</h1>
    </div>

    <h2 style="color: #333;">Je hebt een antwoord ontvangen</h2>

    <p>Beste {{ $contactMessage->name }},</p>

    <p>Bedankt voor uw contactbericht. Hieronder vindt u ons antwoord:</p>

    <div style="background-color: #f8f9fa; padding: 15px; border-left: 4px solid #0056FF; margin: 20px 0;">
        <p style="margin: 0; white-space: pre-wrap;">{{ $replyMessage }}</p>
    </div>

    <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; font-size: 14px; color: #666;">
        <p style="margin: 0 0 10px 0;"><strong>Uw originele bericht:</strong></p>
        <p style="margin: 0 0 5px 0;"><strong>Onderwerp:</strong> {{ $contactMessage->subject }}</p>
        <p style="margin: 0; white-space: pre-wrap;">{{ $contactMessage->message }}</p>
    </div>

    <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

    <p style="color: #666; font-size: 14px;">
        Met vriendelijke groet,<br>
        Het PhoneShop Team
    </p>

    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #999; font-size: 12px;">
        <p style="margin: 0;">Dit is een automatisch gegenereerd antwoord. Reageer niet direct op deze e-mail.</p>
        <p style="margin: 5px 0 0 0;">Voor vragen kunt u ons bereiken via het contactformulier op onze website.</p>
    </div>
</body>
</html>

