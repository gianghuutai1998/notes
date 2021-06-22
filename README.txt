### DATABASE ########################################################

CREATE DATABASE NOTE;
USE NOTE;

CREATE TABLE user(
    username varchar(50) NOT NULL PRIMARY KEY,
    pass varchar(50) NOT NULL
)

CREATE TABLE note(
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title nvarchar(500) NOT NULL,
    content nvarchar(1000),
    username varchar(50) NOT NULL
)

ALTER TABLE note ADD CONSTRAINT user FOREIGN KEY(username) REFERENCES user(username);

### SIGN UP #########################################################
    Tạo tài khoản
    - Username và Password không được để trống.
    - Username chưa tồn tại trong database.
    - Password và Confirm Password phải giống nhau.
    - Sau khi nhập thông tin chọn Sign Up để tạo.
    - Khi tạo tài khoản thành công sẽ tự động chuyển đến trang đăng nhập.                                   
                                                                                                            
### LOGIN ###########################################################                                       
    Đăng nhập                                                                                               
    - Nhập Username và Password đã được tạo để đăng nhập.                                                   
    - Sau khi đăng nhập thành công sẽ khởi tạo SESSION['User'] để được sử dụng các chức năng của Notes.     
    - Đăng nhập thành công sẽ tự động chuyển tới trang Notes.                                               
                                                                                                            
### LOGOUT ##########################################################                                       
    Đăng xuất                                                                                               
    - Hủy SESSION['User'] và trở về trang Login.                                                            
                                                                                                            
### NOTES ###########################################################                                       
    Trang chính Ghi chú                                                                                     
    - Hiển thị danh sách ghi chú.                                                                           
    - Thêm ghi chú, chọn Add để thực hiện                                                                                      
    - Sửa ghi chú, chọn duy nhất 1 hàng và ấn Update đẻ thực hiện.                                                                                         
    - Xóa ghi chú, sau khi chọn checkbox tương ứng với ghi chú cần xóa -> chọn Delete                                                                                        
    - Dowload file ghi chú
    - Upload file ghi chú. File được tải lên nội dung sẽ được chuyển vào database
        với title là tên file và content là nội dung file.                                                                 
                                                                                                            
### ADD-UPDATE ######################################################                                       
    Trang nhập thông tin khi tạo mới hoặc sửa ghi chú được chọn ở Notes                                     
    - Tiêu đề không được bỏ trống.                                                                          
    - Lưu ghi chú mới / cập nhật ghi chú.                                                                   
    - Sau khi lưu thành công sẽ chuyển về trang Notes.                                                      
                                                                                                            