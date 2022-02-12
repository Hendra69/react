import React, { useEffect, useState } from "react";
import {
  Button,
  Col,
  DatePicker,
  Form,
  Input,
  InputNumber,
  Popover,
  Row,
  Select,
  Space,
  Table,
} from "antd";
import dayjs from "dayjs";
import _ from "lodash";
import { Delete } from "react-iconly";

export const DeliveryForm = ({
  children,
  form,
  initialValues,
  name,
  onFinish,
  deliveryTypes,
  customers,
  tankCategories,
  drivers,
  vehicles,
}) => {
  const [tankCategoryDropdowns, setTankCategoryDropdowns] = useState([]);

  useEffect(() => {
    setTankCategoryDropdowns(
      tankCategories.map((item) => ({ label: item.name, value: item.id }))
    );
  }, [tankCategories]);

  const [dataSource, setDataSource] = useState([]);

  const columns = [
    {
      title: "Kategori Tabung",
      dataIndex: "name",
      key: "name",
    },
    {
      title: "Jumlah",
      dataIndex: "qty",
      key: "qty",
      render: (text, record) => (
        <InputNumber
          defaultValue={record.qty ?? 1}
          min={1}
          onChange={handleQty(record.id)}
        />
      ),
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Hapus">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleClickDelete = (id) => () => {
    setDataSource((prevData) => prevData.filter((data) => data.id !== id));
  };

  useEffect(() => {
    form.setFieldsValue({
      tank_categories: dataSource,
      tank_categories_id: dataSource.map((data) => {
        if (data.delivery_id) {
          return data.tank_category_id;
        }
        return data.id;
      }),
    });
  }, [dataSource]);

  const handleQty = (id) => (value) => {
    setDataSource((prevData) =>
      prevData.map((data) => (data.id === id ? { ...data, qty: value } : data))
    );
  };

  const handleValuesChange = (changedValues, allValues) => {
    if (changedValues.tank_categories_id) {
      const updatedCategoriesId = changedValues.tank_categories_id;

      const currentCategoriesId = _.map(dataSource, "id");

      // delete old
      const currentData = dataSource.filter((data) =>
        updatedCategoriesId.includes(data.id)
      );

      // add new
      const newCategoriesId = updatedCategoriesId.filter(
        (id) => !currentCategoriesId.includes(id)
      );
      const newData = tankCategories
        .filter((item) => newCategoriesId.includes(item.id))
        .map((data) => ({ ...data, qty: 1 }));

      setDataSource([...currentData, ...newData]);
    }
  };

  useEffect(() => {
    if (initialValues) {
      setDataSource(initialValues.tank_categories);

      form.setFieldsValue({
        tank_categories_id: _.map(
          initialValues.tank_categories,
          "tank_category_id"
        ),
        customer_id: initialValues.customer.customer_id,
        driver_id: initialValues.driver.user_id,
        vehicle_id: initialValues.vehicle.vehicle_id,
      });
    }
  }, [initialValues]);

  return (
    <Form
      layout="vertical"
      form={form}
      name={name}
      initialValues={initialValues ?? { date: dayjs() }}
      onFinish={onFinish}
      onValuesChange={handleValuesChange}
    >
      <Row gutter={[32, 0]}>
        <Col span={8}>
          <Form.Item
            name="date"
            label="Tanggal Surat"
            rules={[{ required: true, message: "Tanggal surat dibutuhkan" }]}
          >
            <DatePicker
              style={{ width: "100%" }}
              format={["DD/MM/YYYY", "YYYY-MM-DD"]}
            />
          </Form.Item>
        </Col>

        <Col span={8}>
          <Form.Item
            name="type"
            label="Jenis Surat"
            rules={[{ required: true, message: "Jenis surat dibutuhkan" }]}
          >
            <Select
              options={deliveryTypes}
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>
        </Col>

        <Col span={8}>
          <Form.Item
            name="customer_id"
            label="Pelanggan"
            rules={[{ required: true, message: "Pelanggan dibutuhkan" }]}
          >
            <Select
              options={customers}
              optionFilterProp="label"
              optionLabelProp="label"
              showSearch
            />
          </Form.Item>
        </Col>

        <Col span={24}>
          <Form.Item
            name="tank_categories_id"
            label="Kategori tabung"
            rules={[{ required: true, message: "Kategori tabung dibutuhkan" }]}
          >
            <Select
              mode="multiple"
              options={tankCategoryDropdowns}
              optionFilterProp="label"
              optionLabelProp="label"
              showSearch
            />
          </Form.Item>

          <Form.Item name="tank_categories" hidden noStyle>
            <Input />
          </Form.Item>

          <Table
            columns={columns}
            dataSource={dataSource}
            rowKey="id"
            pagination={false}
            className="da-mb-32"
            bordered={true}
          />
        </Col>

        <Col span={8}>
          <Form.Item
            name="driver_id"
            label="Driver"
            rules={[{ required: true, message: "Driver dibutuhkan" }]}
          >
            <Select
              options={drivers}
              optionFilterProp="label"
              optionLabelProp="label"
              showSearch
            />
          </Form.Item>
        </Col>

        <Col span={8}>
          <Form.Item
            name="vehicle_id"
            label="Kendaraan"
            rules={[{ required: true, message: "Kendaraan dibutuhkan" }]}
          >
            <Select
              options={vehicles}
              optionFilterProp="label"
              optionLabelProp="label"
              showSearch
            />
          </Form.Item>
        </Col>

        <Col span={8}>
          <Form.Item name="note" label="Informasi Tambahan">
            <Input.TextArea placeholder="Informasi tambahan" rows={4} />
          </Form.Item>
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
