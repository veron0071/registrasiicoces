<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #d90429 0%, #a00320 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            background: white;
            padding: 30px;
            border: 1px solid #e0e0e0;
            border-top: none;
        }
        .zoom-box {
            background: #f8f9fa;
            border: 2px dashed #d90429;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .zoom-link {
            display: inline-block;
            background: #d90429;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: bold;
            margin: 10px 0;
        }
        .zoom-link:hover {
            background: #a00320;
        }
        .meeting-details {
            margin: 15px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: bold;
            color: #666;
        }
        .detail-value {
            color: #333;
            font-family: monospace;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
            font-size: 12px;
        }
        .highlight {
            color: #d90429;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎥 ICoCES 2026 - Zoom Meeting Link</h1>
    </div>
    
    <div class="content">
        <p>Dear <strong>{{ $participant->full_name }}</strong>,</p>
        
        <p>Thank you for registering for the <span class="highlight">International Conference on Community Engagement for Sustainability 2026</span>. Your payment has been verified, and we're excited to welcome you!</p>
        
        <div class="zoom-box">
            <h3 style="margin-top: 0; color: #d90429;">📹 Join the Conference</h3>
            <a href="{{ $zoomLink }}" class="zoom-link">Click Here to Join Zoom</a>
            
            <div class="meeting-details">
                <div class="detail-row">
                    <span class="detail-label">Meeting ID:</span>
                    <span class="detail-value">{{ $meetingId }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Passcode:</span>
                    <span class="detail-value">{{ $passcode }}</span>
                </div>
            </div>
        </div>
        
        <p><strong>Important Information:</strong></p>
        <ul>
            <li>Please join the meeting 5-10 minutes early</li>
            <li>Use your real name when joining for attendance verification</li>
            <li>Keep your microphone muted when not speaking</li>
            <li>For presenters: screen sharing will be available during your session</li>
        </ul>
        
        <p>If you experience any technical issues, please reply to this email or contact our support team.</p>
        
        <p>We look forward to seeing you at the conference!</p>
        
        <p>Best regards,<br>
        <strong>ICoCES 2026 Committee</strong></p>
    </div>
    
    <div class="footer">
        <p>This email was sent to {{ $participant->email }}</p>
        <p>International Conference on Community Engagement for Sustainability 2026</p>
    </div>
</body>
</html>
