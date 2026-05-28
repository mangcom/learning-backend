<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 8: User Authentication & Security (JWT)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .jwt-structure {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            font-family: monospace;
            font-size: 1.1rem;
            text-align: center;
            font-weight: bold;
        }

        .jwt-part {
            padding: 10px;
            border-radius: 6px;
            color: #fff;
            flex: 1;
        }

        .jwt-header {
            background-color: #ef4444;
        }

        .jwt-payload {
            background-color: #a855f7;
        }

        .jwt-signature {
            background-color: #3b82f6;
        }

        .security-box {
            background-color: #fff1f2;
            border-left: 4px solid #e11d48;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .step-badge {
            background: #2563eb;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <a href="index.php" class="back-link">
                <span class="arrow-icon">⬅</span>
                <span>กลับสู่หน้าหลักวิชา</span>
            </a>
            <h2>หน่วยที่ 8: User Authentication & Security (JWT)</h2>
            <p>สัปดาห์ที่ 12-13 | เวลาเรียนรวม 10 ชั่วโมง (ทฤษฎี 2 ชม. ปฏิบัติ 8 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญประจำหน่วย (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        ความปลอดภัยคือหัวใจหลักของแอปพลิเคชัน การพัฒนาระบบหลังบ้านต้องแยกให้ออกระหว่าง <strong>Authentication (การยืนยันตัวตน - คุณคือใคร?)</strong> และ <strong>Authorization (การอนุญาตสิทธิ์ - คุณทำอะไรได้บ้าง?)</strong> กฎเหล็กข้อแรกคือ "ห้ามเก็บรหัสผ่านผู้ใช้เป็นข้อความธรรมดาเด็ดขาด" เราจะใช้การ <strong>Hashing</strong> ข้อมูล และเมื่อผู้ใช้ล็อกอินสำเร็จ ระบบจะออกตั๋วที่เรียกว่า <strong>JSON Web Token (JWT)</strong> ให้ผู้ใช้นำไปใช้แนบมากับ Request ในครั้งต่อๆ ไป เพื่อเข้าถึงข้อมูลความลับโดยที่เซิร์ฟเวอร์ไม่ต้องจดจำสถานะ (Stateless)
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>🔒 1. การแฮชรหัสผ่าน (Password Hashing) ด้วย bcrypt</h3>
                <p><strong>การแฮช (Hashing)</strong> ไม่ใช่การเข้ารหัส (Encryption) เพราะการเข้ารหัสสามารถถอดรหัสกลับมาอ่านได้ แต่การแฮชคือการแปลงข้อความให้กลายเป็นชุดตัวอักษรแบบสุ่มทางคณิตศาสตร์แบบ <strong>"ทางเดียว (One-way)"</strong> ไม่สามารถแปลงกลับมาเป็นรหัสผ่านเดิมได้</p>

                <div class="security-box">
                    <strong>💡 ทำไมต้องมี Salt?</strong>
                    <p style="margin-top: 5px; font-size: 0.9rem; color: #4c0519;">
                        หากผู้ใช้ 2 คนตั้งรหัสผ่านเหมือนกันว่า <code>123456</code> ค่าแฮชที่ได้ก็จะเหมือนกันเป๊ะ ทำให้แฮกเกอร์เดารหัสได้ง่าย (ผ่าน Rainbow Table) เราจึงต้องใส่ <strong>Salt (เกลือ)</strong> หรือข้อความสุ่มแทรกเข้าไปก่อนทำการแฮช เพื่อให้รหัสผ่าน <code>123456</code> ของทั้ง 2 คน ออกมาเป็นค่าแฮชที่ไม่เหมือนกันเลย
                    </p>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🎟️ 2. สถาปัตยกรรม JSON Web Token (JWT)</h3>
                <p>เมื่อผู้ใช้ล็อกอินด้วย Username และ Password ถูกต้อง เซิร์ฟเวอร์จะออกตั๋ว JWT คืนกลับไปให้ ไคลเอนต์ (เช่น React, Vue หรือ Mobile App) จะเก็บตั๋วนี้ไว้ และแนบตั๋วนี้ส่งกลับมาที่เซิร์ฟเวอร์ทุกครั้งที่ต้องการเข้าถึงข้อมูลที่ถูกล็อกไว้</p>



                <h4>โครงสร้างของ JWT ประกอบด้วย 3 ส่วน (คั่นด้วยจุด):</h4>
                <div class="jwt-structure">
                    <div class="jwt-part jwt-header">Header<br><span style="font-size:0.7rem; font-weight:normal;">(อัลกอริทึม)</span></div>
                    <div>.</div>
                    <div class="jwt-part jwt-payload">Payload<br><span style="font-size:0.7rem; font-weight:normal;">(ข้อมูลสิทธิ์/ID)</span></div>
                    <div>.</div>
                    <div class="jwt-part jwt-signature">Signature<br><span style="font-size:0.7rem; font-weight:normal;">(ลายเซ็นลับ)</span></div>
                </div>

                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li><strong>1. Header:</strong> บอกประเภทของ Token และอัลกอริทึมที่ใช้เข้ารหัส (เช่น HMAC SHA256)</li>
                    <li><strong>2. Payload:</strong> เก็บข้อมูล (Claims) ของผู้ใช้ เช่น User ID, Role (แอดมินหรือผู้ใช้ทั่วไป) <span style="color: #ef4444;">*ห้ามเก็บข้อมูลความลับอย่างรหัสผ่านหรือบัตรเครดิตไว้ในนี้เด็ดขาด เพราะใครก็เปิดอ่านได้*</span></li>
                    <li><strong>3. Signature:</strong> ลายเซ็นดิจิทัลที่เซิร์ฟเวอร์สร้างขึ้นจาก "รหัสลับ (Secret Key)" ของเซิร์ฟเวอร์เท่านั้น หากมีคนแอบแก้ไขข้อมูลใน Payload ลายเซ็นนี้จะพังทันที และเซิร์ฟเวอร์จะปฏิเสธ Token นั้น</li>
                </ul>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>💻 3. ปฏิบัติการประจำหน่วย (Lab Exercise)</h3>
                <p><strong>🚀 ชื่องาน:</strong> พัฒนาระบบ Register/Login และ Middleware ป้องกัน Route ด้วย JWT</p>
                <p><strong>วัตถุประสงค์:</strong> นักศึกษาสามารถนำความรู้ไปใช้งานจริงในโปรเจกต์ระดับ Production ได้อย่างสมบูรณ์</p>

                <br>
                <h4>🛠️ ขั้นตอนการทดลอง:</h4>
                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> สร้างโปรเจกต์และติดตั้ง Dependencies ที่จำเป็น <br><span style="font-size: 0.85rem; color: #64748b;">(หมายเหตุ: เราใช้ `bcryptjs` แทน `bcrypt` เพื่อหลีกเลี่ยงปัญหา Error การคอมไพล์ C++ บนระบบ Windows ของนักศึกษา)</span></p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>npm init -y
npm install express bcryptjs jsonwebtoken</code></pre>
                    </div>

                    <p><span class="step-badge">ขั้นตอนที่ 2</span> สร้างไฟล์ <strong><code class="inline-code">auth-server.js</code></strong> และเขียนโค้ดระบบหลังบ้านดังนี้ (โค้ดชุดนี้ครอบคลุม Register, Login และการสร้าง Custom Middleware แล้ว):</p>
                </div>

                <div class="code-window" style="margin-top: 15px;">
                    <div class="code-header">
                        <span>javascript (auth-server.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const app = express();
app.use(express.json());

// รหัสลับของเซิร์ฟเวอร์ (ในงานจริงต้องเก็บในไฟล์ .env ห้ามนำมาเปิดเผยในโค้ดเด็ดขาด!)
const SECRET_KEY = "my_super_secret_key_bangna"; 

// จำลองฐานข้อมูล (เพื่อความเข้าใจง่ายใน Lab นี้ เราจะใช้ Array แทน DB จริง)
const usersDB = [];

// ==========================================
// 1. ระบบสมัครสมาชิก (Register) - แฮชรหัสผ่าน
// ==========================================
app.post('/api/register', async (req, res) => {
    try {
        const { username, password } = req.body;

        // เช็กว่ามี user นี้หรือยัง
        const userExists = usersDB.find(u => u.username === username);
        if (userExists) return res.status(400).json({ message: "ชื่อผู้ใช้นี้ถูกใช้งานแล้ว!" });

        // 🟢 สร้าง Salt และเข้ารหัสผ่าน (Hashing)
        const salt = await bcrypt.genSalt(10); 
        const hashedPassword = await bcrypt.hash(password, salt);

        // บันทึกลงฐานข้อมูล (เก็บค่า Hashed Password ห้ามเก็บรหัสจริง)
        const newUser = { id: usersDB.length + 1, username, password: hashedPassword };
        usersDB.push(newUser);

        res.status(201).json({ message: "สมัครสมาชิกสำเร็จ!", user: { id: newUser.id, username } });
    } catch (err) {
        res.status(500).json({ message: "Server Error", error: err.message });
    }
});

// ==========================================
// 2. ระบบเข้าสู่ระบบ (Login) - เปรียบเทียบแฮช และแจก JWT
// ==========================================
app.post('/api/login', async (req, res) => {
    try {
        const { username, password } = req.body;

        // 1. ค้นหา User ในระบบ
        const user = usersDB.find(u => u.username === username);
        if (!user) return res.status(400).json({ message: "ไม่พบชื่อผู้ใช้นี้ในระบบ" });

        // 2. 🟢 นำรหัสผ่านที่กรอกมา เทียบกับรหัสแฮชในฐานข้อมูล
        const isMatch = await bcrypt.compare(password, user.password);
        if (!isMatch) return res.status(401).json({ message: "รหัสผ่านไม่ถูกต้อง!" });

        // 3. 🟢 ถ้ารหัสถูก ให้สร้างตั๋ว JWT
        const payload = { id: user.id, username: user.username, role: "member" };
        
        // เซ็นชื่อตั๋วด้วยรหัสลับ กำหนดให้ตั๋วหมดอายุใน 1 ชั่วโมง
        const token = jwt.sign(payload, SECRET_KEY, { expiresIn: '1h' });

        res.status(200).json({ message: "ล็อกอินสำเร็จ", token: token });
    } catch (err) {
        res.status(500).json({ message: "Server Error" });
    }
});

// ==========================================
// 3. 🛡️ Custom Middleware สำหรับตรวจตั๋ว JWT
// ==========================================
const verifyToken = (req, res, next) => {
    // ดึง Token ออกมาจาก Header ชื่อ Authorization
    const authHeader = req.headers['authorization'];
    
    // รูปแบบมาตรฐานคือ "Bearer <token>"
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
        return res.status(403).json({ message: "ปฏิเสธการเข้าถึง: ไม่พบ Token" });
    }

    const token = authHeader.split(' ')[1]; // ตัดคำว่า Bearer ออก เอาแค่ Token ตัวอักษรยาวๆ

    // ตรวจสอบว่า Token ถูกต้องและยังไม่หมดอายุหรือไม่
    jwt.verify(token, SECRET_KEY, (err, decoded) => {
        if (err) return res.status(401).json({ message: "Token ไม่ถูกต้อง หรือหมดอายุแล้ว!" });
        
        // ถ้าตั๋วผ่าน แอบเก็บข้อมูล Payload ไว้ใน req.user เพื่อให้ Route ปลายทางเรียกใช้ได้
        req.user = decoded; 
        next(); // ให้ผ่านไปทำคำสั่งถัดไปได้
    });
};

// ==========================================
// 4. เส้นทางที่ถูกล็อก (Protected Route)
// ==========================================
app.get('/api/profile', verifyToken, (req, res) => {
    // Route นี้จะเข้าได้เฉพาะคนที่มี Token ถูกต้องเท่านั้น!
    res.status(200).json({
        message: "ยินดีต้อนรับเข้าสู่พื้นที่ลับ!",
        userData: req.user // ข้อมูลที่ถอดรหัสมาจาก Token
    });
});

app.listen(4000, () => console.log('🚀 Auth Server รันแล้วที่ http://localhost:4000'));</code></pre>
                </div>

                <div style="margin-top: 25px; line-height: 1.8;">
                    <h4>🧪 ขั้นตอนที่ 3: วิธีการทดสอบผ่าน Postman (สำคัญมาก)</h4>
                    <p>ระบบ Auth จะต้องยิงทดสอบตามลำดับขั้นตอนดังนี้:</p>
                    <ul style="margin-left: 20px;">
                        <li><strong>Step 1: Register</strong> <br>ยิง <code class="inline-code" style="color:#3b82f6;">POST http://localhost:4000/api/register</code> <br>ส่ง Body (JSON) `{"username": "admin", "password": "123"}`</li>
                        <li><strong>Step 2: Login</strong> <br>ยิง <code class="inline-code" style="color:#3b82f6;">POST http://localhost:4000/api/login</code> ด้วยรหัสเดิม <br>คุณจะได้ <code class="inline-code">token</code> ที่เป็นตัวอักษรยาวๆ สีแดงๆ ให้ทำการ <strong>"คัดลอก (Copy)"</strong> Token นั้นไว้</li>
                        <li><strong>Step 3: พยายามเข้า Route ลับแบบไม่มี Token (จะโดนเตะออก)</strong> <br>ยิง <code class="inline-code" style="color:#10b981;">GET http://localhost:4000/api/profile</code> จะพบข้อความ "ปฏิเสธการเข้าถึง"</li>
                        <li><strong>Step 4: เข้า Route ลับด้วย Token (Authorization)</strong> <br>ใน Postman ไปที่แท็บ <strong>Authorization</strong> ➔ เลือก Type เป็น <strong>Bearer Token</strong> ➔ นำ Token ที่คัดลอกไว้ไปวางในช่อง Token ➔ กด Send!</li>
                    </ul>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 8: การต่อยอดระบบ Role-Based Access Control (RBAC)</strong></p>
                <br>
                <p><strong>คำสั่งในการปฏิบัติงาน:</strong></p>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>ให้นักศึกษาใช้โค้ดจาก Lab เป็นตัวตั้งต้น</li>
                    <li>ให้เพิ่ม Custom Middleware ขึ้นมาอีก 1 ตัว ชื่อว่า <code class="inline-code">isAdmin</code> ต่อจาก <code class="inline-code">verifyToken</code></li>
                    <li>ภายใน <code class="inline-code">isAdmin</code> ให้เช็กว่า <code class="inline-code">req.user.role === 'admin'</code> หรือไม่ ถ้าใช่ให้ <code class="inline-code">next()</code> ถ้าไม่ใช่ให้เตะออก (ส่ง HTTP Status 403)</li>
                    <li>สร้าง Endpoint ใหม่ชื่อ <code class="inline-code">GET /api/admin-dashboard</code> โดยฝัง Middleware 2 ชั้น คือ <code class="inline-code">verifyToken</code> และ <code class="inline-code">isAdmin</code> ไว้ดักหน้า Route</li>
                    <li>ให้ทดสอบจำลองตอน Login เปลี่ยน Payload role ให้เป็น <code>"member"</code> 1 รอบ (ต้องเข้า Dashboard ไม่ได้) และแก้ให้เป็น <code>"admin"</code> 1 รอบ (ต้องเข้าได้)</li>
                    <li>แคปหน้าจอผลการทดสอบ Postman ทั้ง 2 กรณี ส่งเข้าระบบ</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การให้คะแนนตัดเกรดประเมินผล (คะแนนเต็ม 5 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• ความเข้าใจในการสร้าง Middleware <code class="inline-code">isAdmin</code> เพื่อกรองข้อมูล Payload ได้อย่างถูกต้อง (2 คะแนน)</li>
                    <li>• การนำ Middleware มากั้น Route แบบหลายชั้น (Chaining Middlewares) ได้สำเร็จ (1 คะแนน)</li>
                    <li>• ความถูกต้องของการส่ง Status Code ตอบกลับ (เช่น 403 Forbidden เมื่อไม่ใช่ Admin) (1 คะแนน)</li>
                    <li>• ภาพหลักฐานการทดสอบผ่าน Postman ที่แสดง Authorization Token ถูกต้องครบถ้วน (1 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>