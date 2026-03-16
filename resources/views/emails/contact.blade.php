<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        .header { background: #f8f9fa; padding: 10px; text-align: center; border-bottom: 2px solid #000; }
        .content { padding: 20px 0; }
        .footer { font-size: 12px; color: #777; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Website Inquiry</h2>
        </div>
        <div class="content">
            <p><strong>Name:</strong> {{ $senderName }}</p>
            <p><strong>Reply-To:</strong> {{ $senderEmail }}</p>
            <hr>
            <p><strong>Message:</strong></p>
            <p>{!! nl2br(e($senderMessage)) !!}</p>
        </div>
        <div class="footer">
            <p>Sent from the Simada Website on {{ now()->format('d M Y, H:i') }}</p>
        </div>
    </div>
</body>
</html>
