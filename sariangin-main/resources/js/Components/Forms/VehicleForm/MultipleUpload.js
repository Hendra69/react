import React, { useEffect, useState } from "react";
import { message, Button, Modal, Popover, Upload } from "antd";
import { UploadOutlined, PlusOutlined } from "@ant-design/icons";

export const MultipleUpload = (props) => {
  const { initialFileList } = props;

  const [fileList, setFileList] = useState([]);

  const [previewImage, setPreviewImage] = useState(null);
  const [previewVisible, setPreviewVisible] = useState(null);
  const [previewTitle, setPreviewTitle] = useState(null);

  useEffect(() => {
    if (initialFileList) {
      setFileList(initialFileList);
    }
  }, [initialFileList]);

  useEffect(() => {
    props.handleFileList(fileList);
  }, [fileList]);

  const getBase64 = (img, callback) => {
    const reader = new FileReader();
    reader.addEventListener("load", () => callback(reader.result));
    reader.readAsDataURL(img);
  };

  const beforeUpload = (file) => {
    const isJpgOrPng = file.type === "image/jpeg" || file.type === "image/png";
    if (!isJpgOrPng) {
      message.error("Anda hanya bisa upload file JPG/PNG");
    }

    const isLt2M = file.size / 1024 / 1024 < 2;
    if (!isLt2M) {
      message.error("Ukuran gambar harus lebih kecil dari 2MB");
    }

    if (isJpgOrPng && isLt2M) {
      getBase64(file, (imageUrl) => {
        file.thumbUrl = imageUrl;
        setFileList((prevFileList) => [...prevFileList, file]);
      });
    }

    return false;
  };

  const handlePreview = (file) => {
    if (!file.url && !file.preview) {
      file.preview = file.thumbUrl;
    }

    setPreviewImage(file.url || file.preview);
    setPreviewVisible(true);
    setPreviewTitle(
      file.name || file.url.substring(file.url.lastIndexOf("/") + 1)
    );
  };

  const uploadButton = (
    <Popover content="Tambah foto">
      <div>
        <PlusOutlined />
        <div style={{ marginTop: 8 }}>Tambah</div>
      </div>
    </Popover>
  );

  return (
    <React.Fragment>
      <Upload
        name={props.name}
        fileList={[...fileList]}
        listType="picture-card"
        beforeUpload={beforeUpload}
        multiple
        showUploadList
        onRemove={(file) => {
          setFileList((prevFileList) => {
            const index = prevFileList.indexOf(file);
            const newFileList = prevFileList.slice();
            newFileList.splice(index, 1);

            return newFileList;
          });
        }}
        onPreview={handlePreview}
      >
        {uploadButton}
      </Upload>
      <Modal
        visible={previewVisible}
        title={previewTitle}
        footer={null}
        onCancel={() => setPreviewVisible(false)}
      >
        <img alt="example" style={{ width: "100%" }} src={previewImage} />
      </Modal>
    </React.Fragment>
  );
};
