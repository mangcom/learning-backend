<?php
// ตรวจสอบระยะโฟลเดอร์เริ่มต้น (หากหน้าหลักไม่ได้ประกาศไว้ ให้เป็นโฟลเดอร์รูท)
if (!isset($base_dir)) {
    $base_dir = "./";
}
if (!isset($active_nav)) {
    $active_nav = "";
}
?>
<nav class="navbar main-navbar" style="background: #0f172a; padding: 15px 0; border-bottom: 3px solid #2563eb; font-family: 'Sarabun', sans-serif; position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; padding: 0 15px;">

        <a href="<?php echo $base_dir; ?>index.php" style="color: #fff; text-decoration: none; font-weight: 700; font-size: 1.2rem; display: flex; align-items: center; gap: 8px;">
            🎓ระบบจัดการแผนการเรียนรู้ <span style="font-size: 0.85rem; background: #2563eb; padding: 2px 8px; border-radius: 4px; font-weight: 400;">ปวส. IT</span>
        </a>

        <ul style="list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; align-items: center;">
            <li>
                <a href="<?php echo $base_dir; ?>index.php"
                    style="color: <?php echo ($active_nav == 'home') ? '#3b82f6' : '#94a3b8'; ?>; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: color 0.2s;">
                    🏠 รายวิชาทั้งหมด
                </a>
            </li>
            <li>
                <a href="<?php echo $base_dir; ?>backend/index.php"
                    style="color: <?php echo ($active_nav == 'backend') ? '#3b82f6' : '#94a3b8'; ?>; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: color 0.2s;">
                    💻 วิชา Back-End
                </a>
            </li>
            <li>
                <a href="<?php echo $base_dir; ?>server/index.php"
                    style="color: <?php echo ($active_nav == 'server') ? '#3b82f6' : '#94a3b8'; ?>; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: color 0.2s;">
                    🖥️ วิชา Server Linux
                </a>
            </li>
        </ul>

    </div>
</nav>