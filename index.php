<?php
$base_dir = "./"; // อยู่โฟลเดอร์หลักชั้นแรก
$active_nav = "home"; // เปิดสถานะเมนูที่หน้าแรก
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คลังระบบแผนการจัดการเรียนรู้ฐานสมรรถนะ ครูพรชัย ไอที</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght=300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body style="background-color: #f8fafc;">

    <?php include 'components/navbar.php'; ?>

    <div class="page-header" style="background: #1e293b; color: #fff; padding: 50px 0; text-align: center;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
            <h2 style="margin: 0; font-size: 2.2rem; font-weight: 700;">คลังแผนการจัดการเรียนรู้ฐานสมรรถนะ</h2>
            <p style="color: #94a3b8; margin: 10px 0 0 0; font-size: 1.1rem;">หลักสูตรระดับประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.) แผนกวิชาเทคโนโลยีสารสนเทศ</p>
        </div>
    </div>

    <div class="container" style="max-width: 1200px; margin: 40px auto; padding: 0 15px;">
        <h3 style="color: #0f172a; border-bottom: 2px solid #cbd5e1; padding-bottom: 10px; margin-bottom: 30px;">📂 รายชื่อวิชาที่เปิดระบบการเรียนรู้</h3>

        <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 30px;">

            <div class="course-main-card" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <span style="background: #f0fdf4; color: #166534; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 20px;">รหัสวิชา 31901-2002</span>
                    <h4 style="margin: 15px 0 10px 0; color: #0f172a; font-size: 1.3rem; font-weight: 700;">ระบบปฏิบัติการเครื่องแม่ข่าย</h4>
                    <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0 0 20px 0;">เจาะลึกโครงสร้างพื้นฐานระบบไอทีผ่านแกนหลัก Ubuntu Server เรียนรู้งาน CLI, การจัดการสิทธิ์, ระบบไฟร์วอลล์, บริการ DNS, DHCP, Web Server, Container Docker และการแก้ปัญหาเชิงระบบ</p>
                </div>
                <a href="server/index.php" style="display: block; text-align: center; background: #10b981; color: #fff; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: 600; transition: background 0.2s;">เข้าสู่บทเรียนรายวิชา ➔</a>
            </div>

            <div class="course-main-card" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <span style="background: #fff7ed; color: #9a3412; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 20px;">รหัสวิชา 31901-2004</span>
                    <h4 style="margin: 15px 0 10px 0; color: #0f172a; font-size: 1.3rem; font-weight: 700;">การพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Front-End</h4>
                    <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0 0 20px 0;">เรียนรู้การสร้างส่วนติดต่อผู้ใช้ (UI/UX) ที่ทันสมัยและรองรับการทำงานทุกหน้าจอ (Responsive Web Design) เจาะลึกการใช้ HTML5, CSS3 Component Frameworks และโครงสร้างจาวาสคริปต์แอปพลิเคชันยุคใหม่</p>
                </div>
                <a href="frontend/index.php" style="display: block; text-align: center; background: #ea580c; color: #fff; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: 600; transition: background 0.2s;">เข้าสู่บทเรียนรายวิชา ➔</a>
            </div>

            <div class="course-main-card" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <span style="background: #eff6ff; color: #1d4ed8; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 20px;">รหัสวิชา 31901-2005</span>
                    <h4 style="margin: 15px 0 10px 0; color: #0f172a; font-size: 1.3rem; font-weight: 700;">การพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End</h4>
                    <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0 0 20px 0;">ศึกษาโครงสร้างสถาปัตยกรรมแบบไคลเอนต์-เซิร์ฟเวอร์ การเขียนโปรแกรมฝั่งเซิร์ฟเวอร์ด้วยภาษาต่างๆ ระบบจัดการฐานข้อมูลและการทดสอบซอฟต์แวร์ตามมาตรฐานสากล</p>
                </div>
                <a href="backend/index.php" style="display: block; text-align: center; background: #2563eb; color: #fff; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: 600; transition: background 0.2s;">เข้าสู่บทเรียนรายวิชา ➔</a>
            </div>

            <div class="course-main-card" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <span style="background: #f0fdfa; color: #115e59; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 20px;">รหัสวิชา 31901-2007</span>
                    <h4 style="margin: 15px 0 10px 0; color: #0f172a; font-size: 1.3rem; font-weight: 700;">การบริหารจัดการเครือข่าย</h4>
                    <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0 0 20px 0;">การวางแผน ออกแบบ และบริหารโครงสร้างเครือข่ายองค์กร (Network Architecture) เรียนรู้กลไก Routing, Switching, การจัดสรร IP/Subnet, ระบบความปลอดภัยเครือข่าย และเครื่องมือมอนิเตอร์ทราฟฟิกสายสัญญาณ</p>
                </div>
                <a href="network/index.php" style="display: block; text-align: center; background: #0d9488; color: #fff; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: 600; transition: background 0.2s;">เข้าสู่บทเรียนรายวิชา ➔</a>
            </div>

            <div class="course-main-card" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <span style="background: #faf5ff; color: #6b21a8; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 20px;">รหัสวิชา 31901-2008</span>
                    <h4 style="margin: 15px 0 10px 0; color: #0f172a; font-size: 1.3rem; font-weight: 700;">การพัฒนาซอฟต์แวร์รูปแบบเดฟออฟส์ (DevOps)</h4>
                    <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0 0 20px 0;">บูรณาการวงจรการส่งมอบซอฟต์แวร์สมัยใหม่ผ่านกระบวนการ Agile/Kanban, ท่อส่งประกอบ CI/CD (GitHub Actions), ตู้ Container, ความปลอดภัย DevSecOps และระบบเฝ้าระวังโปรดักชันด้วย Grafana</p>
                </div>
                <a href="devops/index.php" style="display: block; text-align: center; background: #7c3aed; color: #fff; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: 600; transition: background 0.2s;">เข้าสู่บทเรียนรายวิชา ➔</a>
            </div>





        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>