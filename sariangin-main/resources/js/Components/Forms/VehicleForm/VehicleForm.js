import React from "react";
import { Button, Col, Form, Input, Row, Select } from "antd";
import { MultipleUpload } from "./MultipleUpload";

export const VehicleForm = ({
  children,
  form,
  initialValues,
  name,
  onFinish,
  vehicleTypes,
}) => {
  const handlePhotos = (fileList) => {
    if (fileList) {
      form.setFieldsValue({ photos: fileList });
    }
  };

  return (
    <Form
      layout="vertical"
      form={form}
      name={name}
      initialValues={initialValues}
      onFinish={onFinish}
    >
      <Row gutter={[32, 32]}>
        <Col span={12}>
          <Form.Item
            name="type"
            label="Kategori"
            rules={[{ required: true, message: "Kategori dibutuhkan" }]}
          >
            <Select
              options={vehicleTypes}
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>

          <Form.Item
            name="license_plate"
            label="No Plat Polisi"
            rules={[{ required: true, message: "No Plat Polisi dibutuhkan" }]}
          >
            <Input placeholder="No Plat Polisi" />
          </Form.Item>
        </Col>

        <Col span={12}>
          <Form.Item name="photos" label="Foto Mobil">
            <MultipleUpload
              handleFileList={handlePhotos}
              initialFileList={initialValues?.photos}
            />
          </Form.Item>

          {children}
        </Col>
      </Row>

      <Form.Item>
        <Button type="primary" htmlType="submit">
          Submit
        </Button>
      </Form.Item>
    </Form>
  );
};
